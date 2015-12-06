<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/6/15
 * Time: 20:27
 */

namespace tests\fixtures;


use frontend\models\game\GameBuilder;

class GameWithPlayerAndOneWorker
{
    public static function getGame()
    {
        $builder = new GameBuilder(['worker' => 1], \Yii::$app->params);
        return $builder->buildGame();
    }

    public static function getBuilder()
    {
        return new GameBuilder(['worker' => 1], \Yii::$app->params);
    }
}