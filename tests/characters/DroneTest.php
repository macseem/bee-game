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
use frontend\models\game\GameBuilder;

class DroneTest extends \PHPUnit_Framework_TestCase
{
    /** @var  Game */
    private $game;
    /** @var  Drone */
    private $drone;

    public function setUp()
    {
        $builder = new GameBuilder(['drone' => 1]);
        $this->game = $builder->buildGame();
        $this->drone = $this->game->searchBee();
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
        $firstLifespan = $this->game->getPlayer()->getLifespan();
        $this->drone->hit($this->game->getPlayer());
        $secondLifespan = $this->game->getPlayer()->getLifespan();
        $this->assertLessThan($firstLifespan, $secondLifespan);
    }

    public function testTakeHit()
    {
        $droneExpected = $this->drone->getLifespan();
        $this->drone->takeHit(0);
        $droneActual = $this->drone->getLifespan();
        $this->assertLessThan($droneExpected, $droneActual);
    }

}
