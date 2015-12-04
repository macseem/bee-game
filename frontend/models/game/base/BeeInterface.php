<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/4/15
 * Time: 03:11
 */

namespace frontend\models\game;


use frontend\models\game\base\CharacterInterface;

interface BeeInterface extends CharacterInterface
{
    public function getType();

    public function getQeen();
}