<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/4/15
 * Time: 03:37
 */

namespace frontend\models\game\base;


use frontend\models\game\pools\interfaces\HoneyPoolInterface;

interface DoctorInterface
{
    public function heal(BeeInterface $bee, HoneyPoolInterface $pool);
}