<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/4/15
 * Time: 10:04
 */

namespace frontend\models\game;


interface GameInterface
{

    public function init(GameStorageInterface $storage);

    public function isStarted();

    public function start();

    public function hit();

    public function end();

    public function reset();

    /**
     * @return PlayerInterface
     */
    public function getPlayer();
}