<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/5/15
 * Time: 01:16
 */

namespace frontend\models\game;


interface GameTimeInterface
{
    public function start();

    public function isStarted();

    public function finish();

    public function isFinished();

    /**
     * @return int
     */
    public function gameTime();

    public function reset();
}