<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/6/15
 * Time: 00:16
 */

namespace frontend\models\game;


use frontend\models\game\base\BeeTypesInterface;
use frontend\models\game\base\CharacterPool;
use frontend\models\game\base\HoneyPool;
use frontend\models\game\characters\Drone;
use frontend\models\game\characters\Healer;
use frontend\models\game\characters\Player;
use frontend\models\game\characters\Queen;
use frontend\models\game\characters\Worker;

class GameBuilder implements GameBuilderInterface
{
    private $config;
    private $storage;
    private $cache;
    private $classes = [
        BeeTypesInterface::BEE_TYPE_DRONE => Drone::class,
        BeeTypesInterface::BEE_TYPE_WORKER => Worker::class,
        BeeTypesInterface::BEE_TYPE_HEALER => Healer::class,
        BeeTypesInterface::BEE_TYPE_QUEEN => Queen::class,
    ];

    public function __construct(GameStorageInterface $storage, array $buildConfig, $typeClasses = null)
    {
        $this->storage = $storage;
        $this->config = $buildConfig;
        if($typeClasses) {
            $this->classes = $typeClasses;
        }
    }

    /**
     * @return GameInterface
     */
    public function getGame()
    {
        if($game = $this->storage->get()){
            return $game;
        }
        return $this->buildGame();
    }

    /**
     * @return GameInterface
     */
    public function buildGame()
    {
        if(!empty($this->cache)){
            return unserialize($this->cache);
        }
        $game = new Game(new CharacterPool(), new HoneyPool());
        $this->setPlayer($game);
        foreach($this->config as $type => $count){
            for($i = 0; $i<$count; $i++){
                $game->getCharacterPool()->addBee(
                    new $this->classes[$type]($game)
                );
            }
        }
        $this->cache = serialize($game);
        return $game;
    }

    private function setPlayer(GameInterface $game)
    {
        $game->getCharacterPool()->setPlayer(new Player());
    }




//    private function set
}