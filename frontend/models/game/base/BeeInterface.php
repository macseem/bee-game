<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/4/15
 * Time: 03:11
 */

namespace frontend\models\game\base;


interface BeeInterface extends CharacterInterface, GetPlayerInterface, GetQueenInterface, BeeTypesInterface
{
    public function getType();
}