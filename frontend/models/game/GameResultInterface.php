<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/5/15
 * Time: 01:14
 */

namespace frontend\models\game;


interface GameResultInterface
{

    const RESULT_WIN = 'win';
    const RESULT_LOSE = 'lose';
    const RESULT_DRAW = 'draw';

    public function setWinResult();

    public function setLoseResult();

    public function setDrawResult();

    /**
     * @return bool
     */
    public function finish();

    public function getResult();
}