<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/6/15
 * Time: 01:21
 */

namespace tests\controllers;


use frontend\controllers\GameController;
use frontend\models\game\base\CharacterPool;
use frontend\models\game\base\HoneyPool;
use frontend\models\game\characters\Player;
use frontend\models\game\characters\Worker;
use frontend\models\game\Game;
use frontend\models\game\GameBuilder;
use frontend\models\game\SessionStorage;
use yii\web\Session;

class GameControllerTest extends \PHPUnit_Framework_TestCase
{
    public function testGetGameLazyLoadFromStorage()
    {
        $expectedGame = new Game(new CharacterPool(), new HoneyPool());
        /** @var Session | \PHPUnit_Framework_MockObject_MockObject $sessionStub */
        $sessionStub = $this->getMockBuilder(Session::class)->disableOriginalConstructor()->setMethods([
            'get', 'set'
        ])->getMock();
        $sessionStub->expects($this->exactly(2))->method('get')
            ->with('game')->willReturn(serialize($expectedGame));

        $storage = new SessionStorage($sessionStub);
        $builder = new GameBuilder(['worker' => 10]);

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
        $expectedGame = new Game(new CharacterPool(), new HoneyPool());
        $expectedGame->getCharacterPool()->setPlayer(new Player);
        $expectedGame->getCharacterPool()->addBee(new Worker($expectedGame));

        /** @var Session | \PHPUnit_Framework_MockObject_MockObject $sessionStub */
        $sessionStub = $this->getMockBuilder(Session::class)->disableOriginalConstructor()->setMethods([
            'get', 'set'
        ])->getMock();
        $sessionStub->expects($this->exactly(1))->method('get')->with('game')->willReturn(false);

        $storage = new SessionStorage($sessionStub);
        $builder = new GameBuilder(['worker' => 1]);

        $method = new \ReflectionMethod(GameController::class, 'getGame');
        $method->setAccessible(true);
        $actualGame = $method->invokeArgs(
            $this->getMock(GameController::class,[],[],'',false),
            [$storage, $builder]
        );

        $this->assertEquals(serialize($expectedGame), serialize($actualGame));
    }
}
