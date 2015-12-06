<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/5/15
 * Time: 00:28
 */

namespace tests\game\inside;


use frontend\models\game\base\CharacterPool;
use frontend\models\game\base\HoneyPool;
use frontend\models\game\characters\Drone;
use frontend\models\game\characters\Player;
use frontend\models\game\Game;
use frontend\models\game\GameBuilder;
use frontend\models\game\GameInterface;

class GameHitTest extends \PHPUnit_Framework_TestCase
{
    /** @var  GameInterface */
    private $game;

    public function setUp()
    {
        $builder = new GameBuilder([]);
        $this->game = $builder->buildGame();
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


    public function testHitDroneByMockCalls()
    {
        /** @var Player | \PHPUnit_Framework_MockObject_MockObject $playerMock */
        $playerMock = $this->getMockObject(Player::class, [$this->game], [
            'beforeHit' => [ 'times' => $this->once(), 'return' => true ],
            'hit' => [ 'times' => $this->once(), 'return' => true ],
            'afterHit' => [ 'times' => $this->once(), 'return' => true ],

        ]);

        /** @var Drone | \PHPUnit_Framework_MockObject_MockObject $droneMock */
        $droneMock = $this->getMockObject(Drone::class, [$this->game], [
            'beforeTakeHit' => [ 'times' => $this->once(), 'return' => true ],
            'takeHit' => [ 'times' => $this->once(), 'return' => true ],
        ]);
        $this->game->getCharacterPool()->setPlayer($playerMock);
        $this->game->getCharacterPool()->addBee($droneMock);
        $this->game->start();
        $this->game->hit();
    }

    public function testHitDroneByLifespan()
    {
        $this->game->getCharacterPool()->addBee(new Drone($this->game));
        $droneExpected = $this->game->searchBee()->getLifespan();
        $playerExpected = $this->game->searchBee()->getLifespan();
        $this->game->start();
        $this->game->hit();
        $droneActual = $this->game->searchBee()->getLifespan();
        $playerActual = $this->game->searchBee()->getLifespan();
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
        $this->game->getCharacterPool()->addBee(new Drone($this->game));
        $this->game->start();
        $this->game->getCharacterPool()->killAllBees();
        $this->game->finish();
        $this->game->hit();
    }
}
