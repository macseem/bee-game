<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/7/15
 * Time: 19:26
 */

namespace tests\tools;


use frontend\models\game\characters\Character;
use frontend\models\game\Game;
use frontend\models\game\tools\healer\Healer;
use frontend\models\game\tools\hitter\Hitter;
use tests\fixtures\GameWithoutCharacters;

class HealerTest extends \PHPUnit_Framework_TestCase
{
    /** @var  Game */
    private $game;

    public function setUp()
    {
        $this->game = GameWithoutCharacters::get();
        $this->game->getHoneyPool()->bringHoney(10000);
    }

    public function tearDown()
    {
        unset($this->game);
    }

    public function testHeal()
    {
        $healer = new Character(Character::BEE_TYPE_HEALER, $this->game, new Healer($this->game));
        $healer->setLifespan(10);
        $healer->step($healer);
        $this->assertGreaterThan(10, $healer->getLifespan());

    }
}
