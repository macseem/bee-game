<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/4/15
 * Time: 22:21
 */

namespace tests\game\outside;


use frontend\models\game\base\CharacterPool;
use frontend\models\game\base\HoneyPool;
use frontend\models\game\Game;
use frontend\models\game\GameInterface;

class GameTest extends \PHPUnit_Framework_TestCase
{
    /** @var  Game */
    private $game;
    /** @var  CharacterPool */
    private $pool;
    
    public function setUp()
    {
        $this->pool = new CharacterPool();
        $this->game = new Game($this->pool, new HoneyPool());
    }

    public function tearDown()
    {
        unset($this->pool, $this->game);
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
        $startedGame = new Game(new CharacterPool(), new HoneyPool());
        $startedGame->start();
        return [
            [ $startedGame, true ],
            [ new Game(new CharacterPool(), new HoneyPool()), false ]
        ];
    }

    public function testStart()
    {
        $this->game->start();
        $this->assertTrue($this->game->isStarted());
    }


    public function testReset()
    {
        $this->game->start();
        $this->game->reset();
        $this->assertFalse($this->game->isStarted());
    }

    public function testWin()
    {
        $this->game->start();
        $this->game->getCharacterPool()->killAll();
        $this->game->win();
        $this->assertTrue($this->game->isFinished());
        $this->assertEquals(GameInterface::RESULT_WIN, $this->game->getResult());
        $this->assertEquals(0, count($this->game->getCharacterPool()->getBees()));
    }

    public function testLose()
    {
        $this->game->start();
        $this->game->lose();
        $this->assertTrue($this->game->isFinished());
        $this->assertEquals(GameInterface::RESULT_LOSE, $this->game->getResult());
    }

    /**
     *
     */
    public function testGameTime()
    {
        $reflection = new \ReflectionClass(Game::class);
        $this->game->start();
        $this->game->finish();

        $started = $this->getReflectionPropertyVal($reflection, $this->game, 'started');
        $finished = $this->getReflectionPropertyVal($reflection, $this->game, 'finished');
        /** @var Game $game */
        $this->assertTrue($this->game->isStarted());
        $this->assertTrue($this->game->isFinished());
        $this->assertEquals($finished - $started, $this->game->gameTime());
    }


}
