<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/4/15
 * Time: 10:04
 */

namespace frontend\models\game;


use frontend\models\game\base\CharacterPoolInterface;
use frontend\models\game\base\GetHoneyPoolInterface;
use frontend\models\game\base\GetPlayerInterface;
use frontend\models\game\base\SearchBeeInterface;

interface GameInterface extends GameTimeInterface, GameResultInterface, SearchBeeInterface, GetPlayerInterface, GetHoneyPoolInterface
{
    /**
     * @return CharacterPoolInterface
     */
    public function getCharacterPool();

    public function hit();

    /**
     * @return array
     */
    public function getConfig();
}