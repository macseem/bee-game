<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/5/15
 * Time: 04:10
 */

namespace tests\characters;


use frontend\models\game\characters\Drone;
use frontend\models\game\characters\Player;
use tests\fixtures\GameWithoutBees;
use tests\fixtures\GameWithoutCharacters;

class PlayerTest extends \PHPUnit_Framework_TestCase
{
    /** @var  Player */
    private $player;
    private $game;

    public function setUp()
    {
        $this->game = GameWithoutBees::get();
        $this->player = $this->game->getPlayer();
    }
    public function tearDown()
    {
        unset($this->player, $this->game);
    }

    public function testGetLifespan()
    {
        $this->assertNotEmpty($this->player->getLifespan());
    }

    public function testSetLifespanSmallerThanMaximum()
    {
        $this->player->setLifespan(1);
        $this->assertEquals(1, $this->player->getLifespan());
    }

    public function testSetLifespanBiggerThanMaximum()
    {
        $lifespan = 1000000000000000;
        $this->player->setLifespan($lifespan);
        $this->assertLessThan($lifespan, $this->player->getLifespan());
    }

    public function testHit()
    {
        $game = GameWithoutCharacters::get();
        $bee = new Drone($game);
        $game->getCharacterPool()->addBee($bee);
        $firstLifespan = $bee->getLifespan();
        $this->player->hit($bee);
        $secondLifespan = $bee->getLifespan();
        $this->assertLessThan($firstLifespan, $secondLifespan);
    }

    public function testTakeHit()
    {
        $expected = $this->player->getLifespan();
        $this->player->takeHit(0);
        $actual = $this->player->getLifespan();
        $this->assertLessThan($expected, $actual);
    }


}
