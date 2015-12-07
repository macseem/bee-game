<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/5/15
 * Time: 00:28
 */

namespace tests\game\inside;


use frontend\models\game\base\CharacterTypesInterface;
use frontend\models\game\characters\Character;
use frontend\models\game\GameInterface;
use frontend\models\game\tools\hitter\Hitter;
use tests\fixtures\GameWithoutBees;

class GameHitTest extends \PHPUnit_Framework_TestCase
{
    /** @var  GameInterface */
    private $game;

    public function setUp()
    {
        $this->game = GameWithoutBees::get();
    }
    public function tearDown()
    {
        unset($this->game);
    }

    private function getMockObject($class, array $args, array $methods)
    {
        $mock = $this->getMockBuilder($class)->enableOriginalConstructor()
            ->setConstructorArgs($args)->setMethods(array_keys($methods))->getMock();
        foreach($methods as $method => $params) {
            $mock->expects($params['times'])->method($method);
        }
        return $mock;
    }


    public function testPlayerHitByMockCalls()
    {
        $drone = new Character(Character::BEE_TYPE_DRONE,$this->game, new Hitter($this->game));

        /** @var Character | \PHPUnit_Framework_MockObject_MockObject $playerMock */
        $playerMock = $this->getMockBuilder(Character::class)->enableOriginalConstructor()
            ->setConstructorArgs([CharacterTypesInterface::BEE_TYPE_PLAYER,$this->game, new Hitter($this->game)])
            ->setMethods(['step'])->getMock();
        $playerMock->expects($this->once())->method('step')->with($drone)->willReturn(true);
        $this->game->getCharacterPool()->setPlayer($playerMock);
        $this->game->getCharacterPool()->addBee($drone);
        $this->game->start();
        $this->game->hit();
    }

    public function testHitDroneByMockCalls()
    {
        $game = GameWithoutBees::get();
        /** @var Character | \PHPUnit_Framework_MockObject_MockObject $droneMock */
        $droneMock = $this->getMockObject(Character::class,
            [CharacterTypesInterface::BEE_TYPE_PLAYER,$this->game, new Hitter($this->game)], [
            'takeHit' => [ 'times' => $this->once(), 'return' => true ],
        ]);
        $game->getCharacterPool()->addBee($droneMock);
        $game->start();
        $game->hit();
    }

    public function testHitDroneByLifespan()
    {
        $drone = new Character(Character::BEE_TYPE_DRONE,$this->game, new Hitter($this->game));

        $this->game->getCharacterPool()->addBee($drone);
        $droneExpected = $this->game->getCharacterPool()->searchBee()->getLifespan();
        $playerExpected = $this->game->getCharacterPool()->getPlayer()->getLifespan();
        $this->game->start();
        $this->game->hit();
        $droneActual = $this->game->getCharacterPool()->searchBee()->getLifespan();
        $playerActual = $this->game->getCharacterPool()->getPlayer()->getLifespan();
        $this->assertLessThan($droneExpected, $droneActual);
        $this->assertLessThan($playerExpected, $playerActual);
    }

    /**
     * @expectedException \frontend\exceptions\NotStartedGameException
     */
    public function testHitNotStartedGame_result_Exception()
    {
        $this->game->hit();
    }

    /**
     * @expectedException \frontend\exceptions\FinishedGameException
     */
    public function testHitAlreadyFinishedGame_result_Exception()
    {
        $drone = new Character(Character::BEE_TYPE_DRONE,$this->game, new Hitter($this->game));

        $this->game->getCharacterPool()->addBee($drone);
        $this->game->start();
        $this->game->getCharacterPool()->killAllBees();
        $this->game->finish();
        $this->game->hit();
    }
}
