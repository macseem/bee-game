<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/6/15
 * Time: 01:21
 */

namespace tests\controllers;


use frontend\controllers\GameController;
use frontend\models\game\GameBuilder;
use frontend\models\game\SessionStorage;
use tests\fixtures\GameWithoutBees;
use tests\fixtures\GameWithPlayerAnd10Workers;
use tests\fixtures\GameWithPlayerAndOneWorker;
use yii\web\Session;

class GameControllerTest extends \PHPUnit_Framework_TestCase
{
    public function testGetGameLazyLoadFromStorage()
    {
        $expectedGame = GameWithoutBees::get();
        /** @var Session | \PHPUnit_Framework_MockObject_MockObject $sessionStub */
        $sessionStub = $this->getMockBuilder(Session::class)->disableOriginalConstructor()->setMethods([
            'get', 'set'
        ])->getMock();
        $sessionStub->expects($this->exactly(2))->method('get')
            ->with('game')->willReturn(serialize($expectedGame));

        $storage = new SessionStorage($sessionStub);
        $builder = GameWithPlayerAnd10Workers::getBuilder();

        $method = new \ReflectionMethod(GameController::class, 'getGame');
        $method->setAccessible(true);
        $actualGame = $method->invokeArgs(
            $this->getMock(GameController::class,[],[],'',false),
            [$storage, $builder]
        );

        $this->assertEquals(serialize($expectedGame), serialize($actualGame));
    }

    public function testGetGameBuildWhenStorageEmpty()
    {
        $expectedGame = GameWithPlayerAndOneWorker::getGame();

        /** @var Session | \PHPUnit_Framework_MockObject_MockObject $sessionStub */
        $sessionStub = $this->getMockBuilder(Session::class)->disableOriginalConstructor()->setMethods([
            'get', 'set'
        ])->getMock();
        $sessionStub->expects($this->exactly(1))->method('get')->with('game')->willReturn(false);

        $storage = new SessionStorage($sessionStub);

        $method = new \ReflectionMethod(GameController::class, 'getGame');
        $method->setAccessible(true);
        $actualGame = $method->invokeArgs(
            $this->getMock(GameController::class,[],[],'',false),
            [$storage, GameWithPlayerAndOneWorker::getBuilder()]
        );

        $this->assertEquals(serialize($expectedGame), serialize($actualGame));
    }
}
