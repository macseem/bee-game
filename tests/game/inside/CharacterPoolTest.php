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

class CharacterPoolTest extends \PHPUnit_Framework_TestCase
{
    /** @var  CharacterPool */
    private static $pool;

    public static function setUpBeforeClass()
    {
        self::$pool = new CharacterPool();
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
        self::$pool->addBee(new Drone());
        self::$pool->addBee(new Drone());
        self::$pool->addBee(new Drone());
        self::$pool->addBee(new Drone());
        self::$pool->addBee(new Drone());
    }

    /**
     * @depends testAddDrone
     */
    public function testAddWorker()
    {
        self::$pool->addBee(new Worker());
        self::$pool->addBee(new Worker());
        self::$pool->addBee(new Worker());
        self::$pool->addBee(new Worker());
        self::$pool->addBee(new Worker());
    }

    /**
     * @depends testAddWorker
     */
    public function testAddHealer()
    {
        self::$pool->addBee(new Healer());
        self::$pool->addBee(new Healer());
        self::$pool->addBee(new Healer());
        self::$pool->addBee(new Healer());
        self::$pool->addBee(new Healer());
    }

    /**
     * @depends testAddHealer
     */
    public function testAddQueen()
    {
        self::$pool->addBee(new Queen());
    }

    /**
     * @expectedException \frontend\exceptions\FullPoolByTypeException
     * @depends testAddQueen
     */
    public function testAdd2Queens()
    {
        self::$pool->addBee(new Queen());
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
