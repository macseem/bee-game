<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/5/15
 * Time: 02:24
 */

namespace tests\game\inside;


use frontend\models\game\characters\base\interfaces\CharacterInterface;
use frontend\models\game\characters\Character;
use frontend\models\game\pools\interfaces\CharacterPoolInterface;
use frontend\models\game\Game;
use frontend\models\game\tools\healer\Healer;
use frontend\models\game\tools\hitter\Hitter;
use frontend\models\game\tools\honeyMaker\HoneyMaker;
use frontend\models\game\tools\lazy\Lazy;
use tests\fixtures\GameWithoutCharacters;

class CharacterPoolTest extends \PHPUnit_Framework_TestCase
{
    /** @var  CharacterPoolInterface */
    private static $pool;
    /** @var  Game */
    private static $game;

    public static function setUpBeforeClass()
    {
        self::$game = GameWithoutCharacters::get();
        self::$pool = self::$game->getCharacterPool();
    }

    public static function tearDownAfterClass()
    {
        self::$pool = null;
    }

    public function testAddPlayer()
    {
        self::$pool->setPlayer(new Character(Character::BEE_TYPE_PLAYER,self::$game, new Hitter(self::$game)));
    }

    /**
     * @depends testAddPlayer
     */
    public function testAddDrone()
    {
        $drone = new Character(Character::BEE_TYPE_DRONE,self::$game, new Hitter(self::$game));
        self::$pool->addBee(clone $drone);
        self::$pool->addBee(clone $drone);
        self::$pool->addBee(clone $drone);
        self::$pool->addBee(clone $drone);
        self::$pool->addBee(clone $drone);
    }

    /**
     * @depends testAddDrone
     */
    public function testAddWorker()
    {
        $drone = new Character(Character::BEE_TYPE_WORKER,self::$game, new HoneyMaker(self::$game));
        self::$pool->addBee(clone $drone);
        self::$pool->addBee(clone $drone);
        self::$pool->addBee(clone $drone);
        self::$pool->addBee(clone $drone);
        self::$pool->addBee(clone $drone);
    }

    /**
     * @depends testAddWorker
     */
    public function testAddHealer()
    {
        $drone = new Character(Character::BEE_TYPE_HEALER,self::$game, new Healer(self::$game));
        self::$pool->addBee(clone $drone);
        self::$pool->addBee(clone $drone);
        self::$pool->addBee(clone $drone);
        self::$pool->addBee(clone $drone);
        self::$pool->addBee(clone $drone);
    }

    /**
     * @depends testAddHealer
     */
    public function testAddQueen()
    {
        self::$pool->addBee( new Character(Character::BEE_TYPE_QUEEN,self::$game, new Lazy(self::$game)));
    }

    /**
     * @expectedException \frontend\exceptions\FullPoolByTypeException
     * @depends testAddQueen
     */
    public function testAdd2Queens()
    {
        self::$pool->addBee( new Character(Character::BEE_TYPE_QUEEN,self::$game, new Lazy(self::$game)));
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
        $this->assertEquals(Character::BEE_TYPE_PLAYER, self::$pool->getPlayer()->getType());
    }

    /**
     * @depends testGetBees
     */
    public function testSearchBee()
    {
        $this->assertInstanceOf(CharacterInterface::class, self::$pool->searchBee());
    }

    /**
     * @depends testSearchBee
     */
    public function testKillAll()
    {
        $expectedCount = count(self::$pool->getBees());
        self::$pool->killAllBees();
        $actualCount = count(self::$pool->getBees());
        $this->assertLessThan($expectedCount, $actualCount);
        $this->assertEquals(0, $actualCount);

    }

}
