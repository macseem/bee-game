<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/5/15
 * Time: 05:52
 */

namespace frontend\models\game\base;


interface GetHoneyPoolInterface
{
    /**
     * @return HoneyPoolInterface
     */
    public function getHoneyPool();
}