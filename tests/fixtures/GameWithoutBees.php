<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/6/15
 * Time: 20:16
 */

namespace tests\fixtures;


use frontend\models\game\GameBuilder;

class GameWithoutBees
{
    /**
     * @return \frontend\models\game\GameInterface
     */
    public static function get()
    {
        $builder = new GameBuilder([], \Yii::$app->params);
        return $builder->buildGame();
    }
}