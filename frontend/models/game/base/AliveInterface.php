<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/4/15
 * Time: 03:20
 */

namespace frontend\models\game\base;


interface AliveInterface
{
    public function getLifespan();

    public function setLifespan($value);

    public function toDie();
}