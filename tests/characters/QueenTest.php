<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/5/15
 * Time: 06:40
 */

namespace tests\characters;


use frontend\models\game\characters\Queen;
use frontend\models\game\characters\Worker;
use frontend\models\game\Game;
use tests\fixtures\GameWithoutCharacters;

class QueenTest extends \PHPUnit_Framework_TestCase
{
    /** @var  Game */
    private $game;
    /** @var  Queen */
    private $queen;
    public function setUp()
    {
        $this->game = GameWithoutCharacters::get();
        $this->game->getCharacterPool()->addBee(new Worker($this->game));
        $this->queen = new Queen($this->game);
        $this->game->getCharacterPool()->addBee($this->queen);
    }
    public function tearDown()
    {
        unset($this->queen, $this->game);
    }

    public function testKillAll()
    {
        $this->queen->killAllBees();
        $this->assertCount(0, $this->game->getCharacterPool()->getBees());
    }

    public function testKillAllCallingInToDieMethod()
    {
        $game = GameWithoutCharacters::get();
        /** @var Queen | \PHPUnit_Framework_MockObject_MockObject $stub */
        $stub = $this->getMockBuilder(Queen::class)->enableOriginalConstructor()
            ->setConstructorArgs([$game])
            ->setMethods(['killAllBees'])->getMock();
        $stub->expects($this->once())->method('killAllBees')->willReturn(true);
        $stub->toDie();
    }
}
