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
use frontend\models\game\tools\hitter\Hitter;
use tests\fixtures\GameWithoutCharacters;

class HitterTest extends \PHPUnit_Framework_TestCase
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
        $drone = new Character(Character::BEE_TYPE_DRONE, $this->game, new Hitter($this->game));
        $firstLifespan = $this->game->getCharacterPool()->getPlayer()->getLifespan();
        $drone->step($this->game->getCharacterPool()->getPlayer());
        $secondLifespan = $this->game->getCharacterPool()->getPlayer()->getLifespan();
        $this->assertLessThan($firstLifespan, $secondLifespan);
    }
}
