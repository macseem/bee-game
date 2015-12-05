<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/5/15
 * Time: 06:13
 */

namespace tests\characters;


use frontend\models\game\base\CharacterPool;
use frontend\models\game\base\HoneyPool;
use frontend\models\game\characters\Healer;
use frontend\models\game\Game;

class HealerTest extends \PHPUnit_Framework_TestCase
{
    /** @var  Game */
    private $game;

    public function setUp()
    {
        $this->game = new Game(new CharacterPool(), new HoneyPool());
        $this->game->getCharacterPool()->addBee(new Healer($this->game));
        $this->game->getHoneyPool()->bringHoney(10000);
    }
    public function tearDown()
    {
        unset($this->game);
    }

    public function testHeal()
    {
        /** @var Healer $healer */
        $healer = $this->game->getCharacterPool()->searchBee();
        $healer->setLifespan(10);
        $healer->heal($healer, $this->game->getHoneyPool());
        $this->assertGreaterThan(10, $healer->getLifespan());
    }

    /**
     * @depends testHeal
     */
    public function testBeforeTakeHit()
    {
        $this->game->getCharacterPool()->searchBee()->takeHit(100);

        $expected = $this->game->getCharacterPool()->searchBee()->getLifespan();
        $this->game->getCharacterPool()->searchBee()->beforeTakeHit();
        $actual = $this->game->getCharacterPool()->searchBee()->getLifespan();
        $this->assertGreaterThan($expected, $actual);
    }


}
