<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/5/15
 * Time: 00:28
 */

namespace tests\game\inside;


use frontend\models\game\characters\Drone;
use frontend\models\game\characters\Player;
use frontend\models\game\Game;

class GameHitTest extends \PHPUnit_Framework_TestCase
{
    private function onceBeforeNowAfter(\PHPUnit_Framework_MockObject_MockObject &$mock, $method)
    {
        $mock->expects($this->once())->method('before' . ucfirst($method))->willReturn(true);
        $mock->expects($this->once())->method($method)->willReturn(true);
        $mock->expects($this->once())->method('after' . ucfirst($method))->willReturn(true);
    }

    public function testHit()
    {
        $player = $this->getMockBuilder(Player::class)->disableOriginalConstructor()->getMock();
        $this->onceBeforeNowAfter($player, 'hit');
        $bee = $this->getMockBuilder(Drone::class)->disableOriginalConstructor()->getMock();
        $this->onceBeforeNowAfter($bee, 'takeHit');
        $game = $this->getMockBuilder(Game::class)->disableOriginalConstructor()->getMock();
        $game->expects($this->once())->method('getPlayer')->willReturn($player);
        $game->expects($this->once())->method('searchBee')->willReturn($bee);

        $method = new \ReflectionMethod(Game::class, 'hit');
        $method->invoke($game);

    }
}
