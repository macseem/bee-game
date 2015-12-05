<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/4/15
 * Time: 10:09
 */

namespace frontend\models\game;


interface GameStorageInterface
{
    /**
     * @return GameInterface|bool FALSE
     */
    public function get();

    /**
     * @param GameInterface $game
     */
    public function save( GameInterface $game);

}