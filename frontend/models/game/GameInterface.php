<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/4/15
 * Time: 10:04
 */

namespace frontend\models\game;


use frontend\models\game\base\GetHoneyPoolInterface;
use frontend\models\game\pools\interfaces\CharacterPoolInterface;

interface GameInterface extends GameTimeInterface, GameResultInterface, GetHoneyPoolInterface
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