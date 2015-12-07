<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/7/15
 * Time: 19:34
 */

namespace tests\tools;


use frontend\models\game\characters\Character;
use frontend\models\game\Game;
use frontend\models\game\tools\honeyMaker\HoneyMaker;
use tests\fixtures\GameWithoutCharacters;

class HoneyMakerTest extends \PHPUnit_Framework_TestCase
{
    /** @var  Game */
    private $game;

    public function setUp()
    {
        $this->game = GameWithoutCharacters::get();
    }

    public function tearDown()
    {
        unset($this->game);
    }

    public function testHit()
    {
        $worker = new Character(Character::BEE_TYPE_WORKER, $this->game, new HoneyMaker($this->game));
        $worker->step($worker);
        $this->assertGreaterThan(0, $this->game->getHoneyPool()->amount());

    }

}
