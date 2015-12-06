<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/5/15
 * Time: 21:35
 */

namespace tests\characters;


use frontend\models\game\characters\base\Bee;
use frontend\models\game\GameBuilder;
use frontend\models\game\GameInterface;
use frontend\models\game\GameResultInterface;

class BeeChild extends Bee{

    public function getLifespanMax()
    {
        return 20;
    }

    public function getHitAmount($criticalPercent)
    {
        return $criticalPercent;
    }

    public function getType(){}
}

class BeeTest extends \PHPUnit_Framework_TestCase
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
    public function testSetId()
    {
        $id = 1;
        $drone = new BeeChild($this->game);
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
        $drone = new BeeChild($this->game);
        $drone->setId(1);
        $drone->setId(1);
    }


    public function testToDieWith1BeeInPoolReturnWin()
    {
        $this->game->getCharacterPool()->addBee(new BeeChild($this->game));
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
        $this->game->getCharacterPool()->addBee(new BeeChild($this->game));
        $this->game->getCharacterPool()->addBee(new BeeChild($this->game));
        $this->game->start();
        $this->game->getCharacterPool()->searchBee()->toDie();

        $this->assertFalse($this->game->isFinished());
        $this->assertEquals(1, count($this->game->getCharacterPool()->getBees()));

    }

    public function testTakeHitWith10CriticalHitPercentReturn10()
    {
        $bee = new BeeChild($this->game);
        $critical = 10;
        $before = $bee->getLifespan();
        $bee->takeHit($critical);
        $after = $bee->getLifespan();
        $this->assertEquals($critical, $before - $after);
    }
}
