<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/6/15
 * Time: 20:33
 */

namespace tests\fixtures;


use frontend\models\game\GameBuilder;

class GameWithPlayerAnd10Workers
{
    public static function getBuilder()
    {
        return new GameBuilder(['worker' => 10], \Yii::$app->params);
    }
}