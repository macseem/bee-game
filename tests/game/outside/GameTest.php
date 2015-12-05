<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/4/15
 * Time: 22:21
 */

namespace tests\game\outside;


use frontend\models\game\base\CharacterPool;
use frontend\models\game\Game;
use frontend\models\game\GameInterface;

class GameTest extends \PHPUnit_Framework_TestCase
{
    /** @var  CharacterPool */
    private $pool;
    
    public function setUp()
    {
        $this->pool = new CharacterPool();    
    }

    private function getReflectionPropertyVal(\ReflectionClass $reflection, $object, $property)
    {
        $property = $reflection->getProperty($property);
        $property->setAccessible(true);
        return $property->getValue($object);
    }
    private function setReflectionProperty(\ReflectionClass $reflection, $object, $property, $value)
    {
        $property = $reflection->getProperty($property);
        $property->setAccessible(true);
        $property->setValue($object, $value);
        return $object;
    }

    private function getMethodStub($class, $method, $willReturn)
    {
        $stubStorage = $this->getMockBuilder($class)->disableOriginalConstructor()->getMock();
        $stubStorage->method($method)->willReturn($willReturn);
        return $stubStorage;
    }

    /**
     * @param Game $game
     * @param $expectedIsStarted
     * @dataProvider isStartedProvider
     */
    public function testIsStarted(Game $game, $expectedIsStarted)
    {
        $this->assertEquals($expectedIsStarted, $game->isStarted());
    }


    public function isStartedProvider()
    {
        $startedGame = new Game(new CharacterPool());
        $startedGame->start();
        return [
            [ $startedGame, true ],
            [ new Game(new CharacterPool()), false ]
        ];
    }

    public function testStart()
    {
        $game = new Game($this->pool);
        $game->start();
        $this->assertTrue($game->isStarted());
    }


    public function testReset()
    {
        $game = new Game($this->pool);
        $game->start();
        $game->reset();
        $this->assertFalse($game->isStarted());
    }

    public function testWin()
    {
        $game = new Game($this->pool);
        $game->start();
        $game->getCharacterPool()->killAll();
        $game->win();
        $this->assertTrue($game->isFinished());
        $this->assertEquals(GameInterface::RESULT_WIN, $game->getResult());
        $this->assertEquals(0, count($game->getCharacterPool()->getBees()));
    }

    public function testLose()
    {
        $game = new Game($this->pool);
        $game->start();
        $game->lose();
        $this->assertTrue($game->isFinished());
        $this->assertEquals(GameInterface::RESULT_LOSE, $game->getResult());
    }

    /**
     *
     */
    public function testGameTime()
    {
        $reflection = new \ReflectionClass(Game::class);
        $game = new Game(new CharacterPool());
        $game->start();
        $game->finish();

        $started = $this->getReflectionPropertyVal($reflection, $game, 'started');
        $finished = $this->getReflectionPropertyVal($reflection, $game, 'finished');
        /** @var Game $game */
        $this->assertTrue($game->isStarted());
        $this->assertTrue($game->isFinished());
        $this->assertEquals($finished - $started, $game->gameTime());
    }


}
