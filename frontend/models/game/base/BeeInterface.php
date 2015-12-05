<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/4/15
 * Time: 03:11
 */

namespace frontend\models\game\base;


interface BeeInterface extends CharacterInterface, GetPlayerInterface, BeeTypesInterface, GetHoneyPoolInterface
{
    public function setId($id);
    public function getId();

    public function getType();
}