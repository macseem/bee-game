<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/6/15
 * Time: 21:20
 */

namespace tests\fixtures;


use frontend\models\game\GameBuilder;

class GameWithPlayerAndOneDrone
{
    public static function get()
    {
        $builder = new GameBuilder(['drone' => 1], \Yii::$app->params);
        return $builder->buildGame();
    }
}