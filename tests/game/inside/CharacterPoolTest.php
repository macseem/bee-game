<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/5/15
 * Time: 02:24
 */

namespace tests\game\inside;


use frontend\exceptions\FullPoolByTypeException;
use frontend\models\game\base\BeeInterface;
use frontend\models\game\base\CharacterPool;
use frontend\models\game\characters\Drone;
use frontend\models\game\characters\Healer;
use frontend\models\game\characters\Player;
use frontend\models\game\characters\PlayerInterface;
use frontend\models\game\characters\Queen;
use frontend\models\game\characters\Worker;
use frontend\models\game\Game;

class CharacterPoolTest extends \PHPUnit_Framework_TestCase
{
    /** @var  CharacterPool */
    private static $pool;
    /** @var  Game */
    private static $game;

    public static function setUpBeforeClass()
    {
        self::$pool = new CharacterPool();
        self::$game = new Game(self::$pool);
    }

    public static function tearDownAfterClass()
    {
        self::$pool = null;
    }

    public function testAddPlayer()
    {
        self::$pool->setPlayer(new Player());
    }

    /**
     * @depends testAddPlayer
     */
    public function testAddDrone()
    {
        self::$pool->addBee(new Drone(self::$game));
        self::$pool->addBee(new Drone(self::$game));
        self::$pool->addBee(new Drone(self::$game));
        self::$pool->addBee(new Drone(self::$game));
        self::$pool->addBee(new Drone(self::$game));
    }

    /**
     * @depends testAddDrone
     */
    public function testAddWorker()
    {
        self::$pool->addBee(new Worker(self::$game));
        self::$pool->addBee(new Worker(self::$game));
        self::$pool->addBee(new Worker(self::$game));
        self::$pool->addBee(new Worker(self::$game));
        self::$pool->addBee(new Worker(self::$game));
    }

    /**
     * @depends testAddWorker
     */
    public function testAddHealer()
    {
        self::$pool->addBee(new Healer(self::$game));
        self::$pool->addBee(new Healer(self::$game));
        self::$pool->addBee(new Healer(self::$game));
        self::$pool->addBee(new Healer(self::$game));
        self::$pool->addBee(new Healer(self::$game));
    }

    /**
     * @depends testAddHealer
     */
    public function testAddQueen()
    {
        self::$pool->addBee(new Queen(self::$game));
    }

    /**
     * @expectedException \frontend\exceptions\FullPoolByTypeException
     * @depends testAddQueen
     */
    public function testAdd2Queens()
    {
        self::$pool->addBee(new Queen(self::$game));
    }

    /**
     * @depends testAdd2Queens
     */
    public function testGetBees()
    {
        $bees = self::$pool->getBees();
        $this->assertEquals(16, count($bees));
    }

    /**
     * @depends testAddPlayer
     */
    public function testGetPlayer()
    {
        $this->assertInstanceOf(PlayerInterface::class, self::$pool->getPlayer());
    }

    /**
     * @depends testGetBees
     */
    public function testSearchBee()
    {
        $this->assertInstanceOf(BeeInterface::class, self::$pool->searchBee());
    }

}
