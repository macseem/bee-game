<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/5/15
 * Time: 05:52
 */

namespace frontend\models\game\base;


use frontend\models\game\pools\interfaces\HoneyPoolInterface;

interface GetHoneyPoolInterface
{
    /**
     * @return HoneyPoolInterface
     */
    public function getHoneyPool();
}