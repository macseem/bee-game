<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/5/15
 * Time: 06:34
 */

namespace tests\characters;


use frontend\models\game\characters\Worker;
use frontend\models\game\Game;
use tests\fixtures\GameWithoutCharacters;

class WorkerTest extends \PHPUnit_Framework_TestCase
{
    /** @var  Game */
    private $game;

    public function setUp()
    {
        $this->game = GameWithoutCharacters::get();
        $this->game->getCharacterPool()->addBee(new Worker($this->game));

    }
    public function tearDown()
    {
        unset($this->game);
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

    public function testBeforeTakeHit()
    {
        /** @var Worker $bee */
        $bee = $this->game->getCharacterPool()->searchBee();
        $expected = $this->game->getHoneyPool()->amount();
        $bee->beforeTakeHit();
        $actual = $this->game->getHoneyPool()->amount();

        $this->assertGreaterThan($expected, $actual);
    }

}
