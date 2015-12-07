<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/7/15
 * Time: 02:59
 */

namespace frontend\models\game\tools\healer;


use frontend\models\game\base\AliveInterface;
use frontend\models\game\pools\interfaces\HoneyPoolInterface;

interface HealerInterface
{
    public function heal(AliveInterface $character, HoneyPoolInterface $pool);
}