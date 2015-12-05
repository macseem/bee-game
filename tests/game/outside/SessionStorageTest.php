<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/5/15
 * Time: 23:40
 */

namespace tests\game\outside;


use frontend\models\game\base\CharacterPool;
use frontend\models\game\base\HoneyPool;
use frontend\models\game\characters\Drone;
use frontend\models\game\characters\Player;
use frontend\models\game\Game;
use frontend\models\game\SessionStorage;
use yii\web\Session;

class SessionStorageTest extends \PHPUnit_Framework_TestCase
{
    /** @var Game */
    private $game;
    /** @var  Session | \PHPUnit_Framework_MockObject_MockObject */
    private $sessionStub;
    /** @var  SessionStorage */
    private $storage;

    public function setUp()
    {
        $this->game = new Game(new CharacterPool(), new HoneyPool());
        $this->game->getCharacterPool()->setPlayer(new Player());
        $this->game->getCharacterPool()->addBee(new Drone($this->game));
        $this->game->getCharacterPool()->addBee(new Drone($this->game));
        $this->game->getCharacterPool()->addBee(new Drone($this->game));
        $this->game->getCharacterPool()->addBee(new Drone($this->game));

        /** @var Session | \PHPUnit_Framework_MockObject_MockObject $sessionStub */
        $this->sessionStub = $this->getMockBuilder(Session::class)->disableOriginalConstructor()->setMethods([
            'get', 'set'
        ])->getMock();
        $this->storage = new SessionStorage($this->sessionStub);
    }
    public function tearDown()
    {
        unset($this->game, $this->sessionStub, $this->storage);
    }

    public function testGet()
    {
        $this->sessionStub->expects($this->exactly(2))->method('get')->withAnyParameters()->willReturn(serialize($this->game));
        $game = $this->storage->get();
        $this->assertEquals(4, count($game->getCharacterPool()->getBees()));
        $this->assertInstanceOf(Player::class, $game->getPlayer());
    }

    /**
     * @depends testGet
     */
    public function testSave()
    {
        $this->game->getCharacterPool()->killAll();
        $this->sessionStub->expects($this->once())->method('set')->with('game', serialize($this->game))->willReturn(true);
        $this->storage->save($this->game);
    }


}
