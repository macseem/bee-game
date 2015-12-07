<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/4/15
 * Time: 22:21
 */

namespace tests\game\outside;


use frontend\models\game\characters\Character;
use frontend\models\game\Game;
use frontend\models\game\GameResultInterface;
use frontend\models\game\tools\hitter\Hitter;
use tests\fixtures\GameWithoutBees;
use tests\fixtures\GameWithoutCharacters;
use tests\fixtures\GameWithPlayerAndOneWorker;

class GameTest extends \PHPUnit_Framework_TestCase
{
    /** @var  Game */
    private $game;

    public function setUp()
    {
        $this->game = GameWithoutBees::get();
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
        $startedGame = GameWithPlayerAndOneWorker::getGame();
        $startedGame->start();
        return [
            [ $startedGame, true ],
            [ GameWithoutCharacters::get(), false ]
        ];
    }

    public function testStart()
    {
        $drone = new Character(Character::BEE_TYPE_DRONE,$this->game, new Hitter($this->game));
        $this->game->getCharacterPool()->addBee($drone);
        $this->game->start();
        $this->assertTrue($this->game->isStarted());
    }

    /**
     * @expectedException \frontend\exceptions\AlreadyStartedGameException
     */
    public function testStartAlreadyStartedGame()
    {
        $drone = new Character(Character::BEE_TYPE_DRONE,$this->game, new Hitter($this->game));
        $this->game->getCharacterPool()->addBee($drone);
        $this->game->start();
        $this->game->start();
    }

    /**
     * @expectedException \frontend\exceptions\CannotStartWithoutCharacterException
     */
    public function testStartGameWithEmptyPlayer()
    {
        $game = GameWithoutCharacters::get();
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
        $drone = new Character(Character::BEE_TYPE_DRONE,$this->game, new Hitter($this->game));
        $this->game->getCharacterPool()->addBee($drone);
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
        $drone = new Character(Character::BEE_TYPE_DRONE,$this->game, new Hitter($this->game));
        $this->game->getCharacterPool()->addBee($drone);
        $this->assertFalse($this->game->finish());
    }

    public function testFinishStartedEmptyGameReturnDraw()
    {
        $drone = new Character(Character::BEE_TYPE_DRONE,$this->game, new Hitter($this->game));
        $this->game->getCharacterPool()->addBee($drone);
        $this->game->start();
        $this->game->getCharacterPool()->killAllBees();
        $this->game->getCharacterPool()->killPlayer();
        $this->assertEquals(GameResultInterface::RESULT_DRAW, $this->game->finish());
    }

    public function testFinishStartedGameWithPlayerAndEmptyBeesReturnWin()
    {
        $drone = new Character(Character::BEE_TYPE_DRONE,$this->game, new Hitter($this->game));
        $this->game->getCharacterPool()->addBee($drone);
        $this->game->start();
        $this->game->getCharacterPool()->killAllBees();
        $this->assertEquals(GameResultInterface::RESULT_WIN, $this->game->finish());
    }

    public function testFinishStartedGameWithBeesAndEmptyPlayerReturnLose()
    {
        $drone = new Character(Character::BEE_TYPE_DRONE,$this->game, new Hitter($this->game));
        $this->game->getCharacterPool()->addBee($drone);
        $this->game->start();
        $this->game->getCharacterPool()->getPlayer()->toDie();
        $this->assertEquals(GameResultInterface::RESULT_LOSE, $this->game->finish());
    }



}
