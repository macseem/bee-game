<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/4/15
 * Time: 03:33
 */

namespace frontend\models\game\characters\base\interfaces;


use frontend\models\game\base\AliveInterface;
use frontend\models\game\base\SetIdInterface;
use frontend\models\game\base\BeforeDeadInterface;
use frontend\models\game\base\CharacterTypesInterface;
use frontend\models\game\base\GameStepInterface;
use frontend\models\game\base\HitTakerInterface;

interface CharacterInterface extends AliveInterface,
    HitTakerInterface,
    BeforeDeadInterface,
    GameStepInterface,
    CharacterTypesInterface,
    SetIdInterface
{
    public function getType();
}