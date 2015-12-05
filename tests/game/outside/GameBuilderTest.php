<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/6/15
 * Time: 00:14
 */

namespace tests\game\outside;


use frontend\models\game\base\BeeTypesInterface;
use frontend\models\game\base\CharacterPool;
use frontend\models\game\base\HoneyPool;
use frontend\models\game\characters\Player;
use frontend\models\game\Game;
use frontend\models\game\GameBuilder;
use frontend\models\game\SessionStorage;
use yii\web\Session;

class GameBuilderTest extends \PHPUnit_Framework_TestCase
{
    public function testGetGameLazyLoadFromStorage()
    {
        $game = new Game(new CharacterPool(), new HoneyPool());
        /** @var Session | \PHPUnit_Framework_MockObject_MockObject $sessionStub */
        $sessionStub = $this->getMockBuilder(Session::class)->disableOriginalConstructor()->setMethods([
            'get', 'set'
        ])->getMock();
        $sessionStub->expects($this->exactly(2))->method('get')->withAnyParameters()->willReturn(serialize($game));
        $storage = new SessionStorage($sessionStub);
        $builder = new GameBuilder($storage, []);
        $this->assertEquals(serialize($game), serialize($builder->getGame()));
    }

    public function testBuildGame_by_config_result_1_character_each_type_not_started()
    {
        $config = array();
        foreach(BeeTypesInterface::BEE_AVAILABLE_TYPES as $type){
            $config[$type] = 1;
        }
        /** @var Session | \PHPUnit_Framework_MockObject_MockObject $sessionStub */
        $sessionStub = $this->getMockBuilder(Session::class)->disableOriginalConstructor()->setMethods([
            'get', 'set'
        ])->getMock();
        $sessionStub->expects($this->atLeastOnce())->method('get')->withAnyParameters()->willReturn(false);
        $builder = new GameBuilder(new SessionStorage($sessionStub), $config);
        $game = $builder->getGame();
        $this->assertInstanceOf(Player::class, $game->getPlayer());
        $this->assertEquals(count(BeeTypesInterface::BEE_AVAILABLE_TYPES), count($game->getCharacterPool()->getBees()));
        foreach(BeeTypesInterface::BEE_AVAILABLE_TYPES as $type){
            foreach($game->getCharacterPool()->getBees() as $bee) {
                if($bee->getType() == $type)
                    continue 2;
            }
            $this->fail("All Available Types should be inside the game");
        }
    }
}
