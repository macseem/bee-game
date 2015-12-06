<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/4/15
 * Time: 03:11
 */

namespace frontend\models\game\characters\base\interfaces;


use frontend\models\game\base\BeeTypesInterface;
use frontend\models\game\base\CharacterInterface;
use frontend\models\game\base\GetHoneyPoolInterface;
use frontend\models\game\base\GetPlayerInterface;

interface BeeInterface extends CharacterInterface, GetPlayerInterface, BeeTypesInterface, GetHoneyPoolInterface
{
    public function setId($id);
    public function getId();
}