<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/5/15
 * Time: 06:34
 */

namespace tests\characters;


use frontend\models\game\base\CharacterPool;
use frontend\models\game\base\HoneyPool;
use frontend\models\game\characters\Worker;
use frontend\models\game\Game;

class WorkerTest extends \PHPUnit_Framework_TestCase
{
    /** @var  Game */
    private $game;

    public function setUp()
    {
        $this->game = new Game(new CharacterPool(), new HoneyPool());
        $this->game->getCharacterPool()->addBee(new Worker($this->game));
    }

    public function testTakeHit()
    {
        $bee = $this->game->getCharacterPool()->searchBee();
        $expected = $bee->getLifespan();
        $bee->takeHit(0);
        $actual = $bee->getLifespan();
        $this->assertLessThan($expected, $actual);
    }

    public function testMakeHoney()
    {
        /** @var Worker $bee */
        $bee = $this->game->getCharacterPool()->searchBee();
        $expected = $this->game->getHoneyPool()->amount();
        $bee->makeHoney($this->game->getHoneyPool());
        $actual = $this->game->getHoneyPool()->amount();

        $this->assertGreaterThan($expected, $actual);
    }

    public function testAfterHit()
    {
        /** @var Worker $bee */
        $bee = $this->game->getCharacterPool()->searchBee();
        $expected = $this->game->getHoneyPool()->amount();
        $bee->afterTakeHit();
        $actual = $this->game->getHoneyPool()->amount();

        $this->assertGreaterThan($expected, $actual);
    }

}
