<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/5/15
 * Time: 05:06
 */

namespace tests\characters;


use frontend\models\game\base\CharacterPool;
use frontend\models\game\base\HoneyPool;
use frontend\models\game\characters\Drone;
use frontend\models\game\characters\Player;
use frontend\models\game\Game;

class DroneTest extends \PHPUnit_Framework_TestCase
{
    /** @var  Game */
    private $game;
    /** @var  Drone */
    private $drone;

    public function setUp()
    {
        $this->game = new Game(new CharacterPool(), new HoneyPool());
        $this->drone = new Drone($this->game);
        $this->game->getCharacterPool()->addBee($this->drone);
    }
    public function tearDown()
    {
        unset($this->drone);
    }

    public function testGetLifespan()
    {
        $this->assertNotEmpty($this->drone->getLifespan());
    }

    public function testSetLifespanSmallerThanMaximum()
    {
        $this->drone->setLifespan(1);
        $this->assertEquals(1, $this->drone->getLifespan());
    }

    public function testSetLifespanBiggerThanMaximum()
    {
        $lifespan = 1000000000000000;
        $this->drone->setLifespan($lifespan);
        $this->assertLessThan($lifespan, $this->drone->getLifespan());
    }

    public function testHit()
    {
        $player = new Player();
        $firstLifespan = $player->getLifespan();
        $this->drone->hit($player);
        $secondLifespan = $player->getLifespan();
        $this->assertLessThan($firstLifespan, $secondLifespan);
    }

    public function testTakeHit()
    {
        $droneExpected = $this->drone->getLifespan();
        $this->drone->takeHit(0);
        $droneActual = $this->drone->getLifespan();
        $this->assertLessThan($droneExpected, $droneActual);
    }

    public function testSetId()
    {
        $id = 1;
        $drone = new Drone($this->game);
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
        $drone = new Drone($this->game);
        $drone->setId(1);
        $drone->setId(1);
    }

}
