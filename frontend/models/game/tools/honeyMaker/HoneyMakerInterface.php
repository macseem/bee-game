<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/7/15
 * Time: 03:05
 */

namespace frontend\models\game\tools\honeyMaker;


use frontend\models\game\pools\HoneyPool;

interface HoneyMakerInterface
{
    public function make(HoneyPool $pool);
}