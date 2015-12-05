<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/4/15
 * Time: 22:59
 */

namespace frontend\models\game;


interface GameBuilderInterface
{
    /**
     * @return GameInterface
     */
    public function buildGame();
}