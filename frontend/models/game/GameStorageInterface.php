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

    public function add($gameId);

    public function update($gameId);

}