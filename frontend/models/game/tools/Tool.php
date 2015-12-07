<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/7/15
 * Time: 02:49
 */

namespace frontend\models\game\tools;


use frontend\models\game\base\GameStepInterface;
use frontend\models\game\characters\base\interfaces\CharacterInterface;
use frontend\models\game\GameInterface;

abstract class Tool implements GameStepInterface
{
    abstract public function step(CharacterInterface $character, GameInterface $game);
}