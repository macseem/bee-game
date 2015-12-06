<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/4/15
 * Time: 03:12
 */

namespace frontend\models\game\characters\interfaces;


use frontend\models\game\characters\base\interfaces\CharacterInterface;
use frontend\models\game\base\HitableInterface;

interface PlayerInterface extends CharacterInterface, HitableInterface
{
    const PLAYER_TYPE = 'player';
}