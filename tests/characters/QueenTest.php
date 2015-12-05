<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/5/15
 * Time: 06:40
 */

namespace tests\characters;


use frontend\models\game\base\CharacterPool;
use frontend\models\game\base\HoneyPool;
use frontend\models\game\characters\Queen;
use frontend\models\game\characters\Worker;
use frontend\models\game\Game;

class QueenTest extends \PHPUnit_Framework_TestCase
{
    /** @var  Game */
    private $game;
    /** @var  Queen */
    private $queen;
    public function setUp()
    {
        $this->game = new Game(new CharacterPool(), new HoneyPool());
        $this->game->getCharacterPool()->addBee(new Worker($this->game));
        $this->queen = new Queen($this->game);
        $this->game->getCharacterPool()->addBee($this->queen);
    }
    public function tearDown()
    {
        unset($this->queen, $this->game);
    }

    public function testTakeHit()
    {
        $bee = $this->queen;
        $expected = $bee->getLifespan();
        $bee->takeHit(0);
        $actual = $bee->getLifespan();
        $this->assertLessThan($expected, $actual);
    }

    public function testKillAll()
    {
        $this->queen->killAll();
        $this->assertCount(0, $this->game->getCharacterPool()->getBees());
    }
}
