<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/7/15
 * Time: 19:05
 */

namespace tests\characters;


use frontend\models\game\base\CharacterTypesInterface;
use frontend\models\game\characters\Character;
use frontend\models\game\GameBuilder;
use frontend\models\game\GameInterface;
use frontend\models\game\GameResultInterface;
use frontend\models\game\tools\hitter\Hitter;
use frontend\models\game\tools\lazy\Lazy;
use tests\fixtures\GameWithoutCharacters;

class CharacterTest extends \PHPUnit_Framework_TestCase
{
    /** @var  GameInterface */
    private $game;

    public function setUp()
    {
        $builder = new GameBuilder([], \Yii::$app->params);
        $this->game = $builder->buildGame();
    }
    public function tearDown()
    {
        unset($this->game);
    }

    public function testConstruct()
    {
        $type = CharacterTypesInterface::BEE_TYPE_DRONE;
        $game = GameWithoutCharacters::get();
        $tool = new Lazy($game);
        /** @var Character | \PHPUnit_Framework_MockObject_MockObject $character */
        $character = $this->getMockBuilder(Character::class)->enableOriginalConstructor()
            ->setConstructorArgs([$type, $game, $tool])->setMethods(['init'])->getMock();
//        $character->expects($this->once())->method('init')->willReturn(true);

        $this->assertEquals($type, $character->getType());

        $gameProp = new \ReflectionProperty(Character::class, 'game');
        $gameProp->setAccessible(true);
        $this->assertEquals(serialize($game), serialize($gameProp->getValue($character)));

        $toolProp = new \ReflectionProperty(Character::class, 'tool');
        $toolProp->setAccessible(true);
        $this->assertEquals(serialize($tool), serialize($toolProp->getValue($character)));
    }

    public function testSetId()
    {
        $id = 1;
        $drone = new Character(Character::BEE_TYPE_DRONE,$this->game, new Hitter($this->game));
        $drone->setId($id);
        $actual = $drone->getId();
        $this->assertEquals($id, $actual);
    }

    /**
     * @depends testSetId
     * @expectedException \frontend\exceptions\ReadOnlyException
     * @throws \frontend\exceptions\ReadOnlyException
     */
    public function testSetIdSecondTime()
    {
        $drone = new Character(Character::BEE_TYPE_DRONE,$this->game, new Hitter($this->game));
        $drone->setId(1);
        $drone->setId(1);
    }

    public function testGetLifespan()
    {
        $drone = new Character(Character::BEE_TYPE_DRONE,$this->game, new Hitter($this->game));

        $this->assertNotEmpty($drone);
    }

    public function testSetLifespanSmallerThanMaximum()
    {
        $drone = new Character(Character::BEE_TYPE_DRONE,$this->game, new Hitter($this->game));
        $drone->setLifespan(1);
        $this->assertEquals(1, $drone->getLifespan());
    }

    public function testSetLifespanBiggerThanMaximum()
    {
        $drone = new Character(Character::BEE_TYPE_DRONE,$this->game, new Hitter($this->game));
        $lifespan = 1000000000000000;
        $drone->setLifespan($lifespan);
        $this->assertLessThan($lifespan, $drone->getLifespan());
    }

    public function testTakeHit()
    {
        $drone = new Character(Character::BEE_TYPE_DRONE,$this->game, new Hitter($this->game)); 
        $droneExpected = $drone->getLifespan();
        $drone->takeHit(0);
        $droneActual = $drone->getLifespan();
        $this->assertLessThan($droneExpected, $droneActual);
    }

    public function testToDieWith1BeeInPoolReturnWin()
    {
        $drone = new Character(Character::BEE_TYPE_DRONE,$this->game, new Hitter($this->game));
        $this->game->getCharacterPool()->addBee($drone);
        $this->game->start();
        $this->game->getCharacterPool()->searchBee()->toDie();
        $this->assertTrue($this->game->isFinished());
        $this->assertEquals(GameResultInterface::RESULT_WIN, $this->game->getResult());
    }

    /**
     * @depends testToDieWith1BeeInPoolReturnWin
     */
    public function testToDieWith2BeesInPoolReturnNotFinishedAndCountBeesInPoolEqualsOne()
    {
        $drone = new Character(Character::BEE_TYPE_DRONE,$this->game, new Hitter($this->game));
        $this->game->getCharacterPool()->addBee(clone $drone);
        $this->game->getCharacterPool()->addBee(clone $drone);
        $this->game->start();
        $this->game->getCharacterPool()->searchBee()->toDie();

        $this->assertFalse($this->game->isFinished());
        $this->assertEquals(1, count($this->game->getCharacterPool()->getBees()));

    }

    public function testQueenToDieWithQueenAndDroneInPool_result_Empty_Pool()
    {
        $drone = new Character(Character::BEE_TYPE_DRONE,$this->game, new Hitter($this->game));
        $queen = new Character(Character::BEE_TYPE_QUEEN,$this->game, new Lazy($this->game));
        $this->game->getCharacterPool()->addBee($drone);
        $this->game->getCharacterPool()->addBee($queen);
        $this->game->start();
        $queen->toDie();
        $this->assertEmpty($this->game->getCharacterPool()->getBees());
        $this->assertEquals(GameResultInterface::RESULT_WIN, $this->game->getResult());
    }
}
