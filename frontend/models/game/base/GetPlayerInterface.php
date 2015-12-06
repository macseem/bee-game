<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/5/15
 * Time: 01:49
 */

namespace frontend\models\game\base;


use frontend\models\game\interfaces\characters\PlayerInterface;

interface GetPlayerInterface
{
    /**
     * @return PlayerInterface
     */
    public function getPlayer();
}