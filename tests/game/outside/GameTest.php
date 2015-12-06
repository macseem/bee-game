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
use frontend\models\game\characters\Drone;
use frontend\models\game\characters\Player;
use frontend\models\game\Game;
use frontend\models\game\GameBuilder;
use frontend\models\game\GameResultInterface;

class GameTest extends \PHPUnit_Framework_TestCase
{
    /** @var  Game */
    private $game;

    public function setUp()
    {
        $builder = new GameBuilder([]);
        $this->game = $builder->buildGame();
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
        $builder = new GameBuilder([]);
        $startedGame = $builder->buildGame();
        $startedGame->getCharacterPool()->addBee(new Drone($startedGame));
        $startedGame->start();
        return [
            [ $startedGame, true ],
            [ new Game(new CharacterPool(), new HoneyPool()), false ]
        ];
    }

    public function testStart()
    {
        $this->game->getCharacterPool()->addBee(new Drone($this->game));
        $this->game->start();
        $this->assertTrue($this->game->isStarted());
    }

    /**
     * @expectedException \frontend\exceptions\AlreadyStartedGameException
     */
    public function testStartAlreadyStartedGame()
    {
        $this->game->getCharacterPool()->addBee(new Drone($this->game));
        $this->game->start();
        $this->game->start();
    }

    /**
     * @expectedException \frontend\exceptions\CannotStartWithoutCharacterException
     */
    public function testStartGameWithEmptyPlayer()
    {
        $game = new Game(new CharacterPool(), new HoneyPool());
        $game->start();
    }

    /**
     * @expectedException \frontend\exceptions\CannotStartWithoutCharacterException
     */
    public function testStartGameWithEmptyBees()
    {
        $this->game->start();
    }

    /**
     *
     */
    public function testGameTime()
    {
        $reflection = new \ReflectionClass(Game::class);
        $this->game->getCharacterPool()->addBee(new Drone($this->game));
        $this->game->start();
        $this->game->getCharacterPool()->killAllBees();
        $this->game->finish();

        $started = $this->getReflectionPropertyVal($reflection, $this->game, 'started');
        $finished = $this->getReflectionPropertyVal($reflection, $this->game, 'finished');
        /** @var Game $game */
        $this->assertTrue($this->game->isStarted());
        $this->assertTrue($this->game->isFinished());
        $this->assertEquals($finished - $started, $this->game->gameTime());
    }

    public function testFinishNotStartedGameReturnFalse()
    {
        $this->assertFalse($this->game->finish());
    }

    public function testFinishStartedNotEmptyGameReturnFalse()
    {
        $this->game->getCharacterPool()->addBee(new Drone($this->game));
        $this->assertFalse($this->game->finish());
    }

    public function testFinishStartedEmptyGameReturnDraw()
    {
        $this->game->getCharacterPool()->addBee(new Drone($this->game));
        $this->game->start();
        $this->game->getCharacterPool()->killAllBees();
        $this->game->getCharacterPool()->killPlayer();
        $this->assertEquals(GameResultInterface::RESULT_DRAW, $this->game->finish());
    }

    public function testFinishStartedGameWithPlayerAndEmptyBeesReturnWin()
    {
        $this->game->getCharacterPool()->addBee(new Drone($this->game));
        $this->game->start();
        $this->game->getCharacterPool()->killAllBees();
        $this->assertEquals(GameResultInterface::RESULT_WIN, $this->game->finish());
    }

    public function testFinishStartedGameWithBeesAndEmptyPlayerReturnLose()
    {
        $this->game->getCharacterPool()->addBee(new Drone($this->game));
        $this->game->start();
        $this->game->getPlayer()->toDie();
        $this->assertEquals(GameResultInterface::RESULT_LOSE, $this->game->finish());
    }



}
