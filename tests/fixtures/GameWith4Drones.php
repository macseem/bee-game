<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/6/15
 * Time: 21:05
 */

namespace tests\fixtures;


use frontend\models\game\GameBuilder;

class GameWith4Drones
{
    public static function get()
    {
        $builder = new GameBuilder(['drone' => 4], \Yii::$app->params);
        return $builder->buildGame();
    }

}