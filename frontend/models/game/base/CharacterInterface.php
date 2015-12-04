<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/4/15
 * Time: 03:33
 */

namespace frontend\models\game\base;


interface CharacterInterface extends AliveInterface, HitTakerInterface, BeforeDeadInterface
{

}