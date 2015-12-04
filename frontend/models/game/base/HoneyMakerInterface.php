<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/4/15
 * Time: 03:55
 */

namespace frontend\models\game\base;


interface HoneyMakerInterface
{
    public function makeHoney(HoneyPoolInterface $honeyPool);
}