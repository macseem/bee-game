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
    public function getLifespanMax();

    public function getLifespan();

    /**
     * @param $value
     * @return int lifespan
     */
    public function setLifespan($value);

    public function toDie();
}