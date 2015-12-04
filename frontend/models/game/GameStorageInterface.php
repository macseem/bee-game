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
    public function get($gameId);

    /**
     * @param GameInterface $game
     * @return $gameId
     */
    public function add( GameInterface $game);

    public function update($gameId);

}