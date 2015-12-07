<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/6/15
 * Time: 00:16
 */

namespace frontend\models\game;


use frontend\models\game\characters\base\Character;
use frontend\models\game\pools\HoneyPool;
use frontend\models\game\pools\CharacterPool;


class GameBuilder implements GameBuilderInterface
{
    private $gameConfig;
    private $buildConfig;
    private $cache;


    public function __construct(array $buildConfig, array $gameConfig)
    {
        $this->buildConfig = $buildConfig;
        $this->gameConfig = $gameConfig;
    }

    /**
     * @return GameInterface
     */
    public function buildGame()
    {
        if(!empty($this->cache)){
            return unserialize($this->cache);
        }
        $game = new Game(new CharacterPool(), new HoneyPool(), $this->gameConfig);
        $this->setPlayer($game);
        foreach($this->buildConfig as $type => $count){
            $tool = $this->gameConfig['characterTools'][$type];
            for($i = 0; $i<$count; $i++){
                $game->getCharacterPool()->addBee(
                    new Character($type, $game, new $tool($game))
                );
            }
        }
        $this->cache = serialize($game);
        return $game;
    }

    private function setPlayer(GameInterface $game)
    {
        $tool = $this->gameConfig['characterTools'][Character::BEE_TYPE_PLAYER];
        $game->getCharacterPool()->setPlayer(new Character(Character::BEE_TYPE_PLAYER, $game, new $tool($game)));
    }

}