<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/6/15
 * Time: 00:14
 */



namespace frontend\models\game{

    function unserialize($str) {
        global $unserializeCalls;
        $unserializeCalls++;
        return \unserialize($str);
    }
}

namespace tests\game\outside {


    use frontend\models\game\base\BeeTypesInterface;
    use frontend\models\game\base\CharacterTypesInterface;
    use frontend\models\game\GameBuilder;


    class GameBuilderTest extends \PHPUnit_Framework_TestCase
    {
        public function testBuildGame_by_config_result_1_character_each_type_not_started()
        {
            $config = array();
            foreach (BeeTypesInterface::BEE_AVAILABLE_TYPES as $type) {
                $config[$type] = 1;
            }
            $builder = new GameBuilder($config, \Yii::$app->params);
            $game = $builder->buildGame();
            $this->assertEquals(CharacterTypesInterface::BEE_TYPE_PLAYER,
                $game->getCharacterPool()->getPlayer()->getType());
            $this->assertEquals(count(BeeTypesInterface::BEE_AVAILABLE_TYPES), count($game->getCharacterPool()->getBees()));
            foreach (BeeTypesInterface::BEE_AVAILABLE_TYPES as $type) {
                foreach ($game->getCharacterPool()->getBees() as $bee) {
                    if ($bee->getType() == $type)
                        continue 2;
                }
                $this->fail("All Available Types should be inside the game");
            }
        }

        public function testCacheCalls()
        {
            global $unserializeCalls;
            $unserializeCalls = 0;
            $builder = new GameBuilder([],\Yii::$app->params);
            $builder->buildGame();
            $builder->buildGame();
            $builder->buildGame();
            $this->assertEquals(2, $unserializeCalls);
        }

    }


}
