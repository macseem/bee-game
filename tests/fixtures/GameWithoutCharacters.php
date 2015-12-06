<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/6/15
 * Time: 20:25
 */

namespace tests\fixtures;


use frontend\models\game\base\CharacterPool;
use frontend\models\game\base\HoneyPool;
use frontend\models\game\Game;
use frontend\models\game\GameInterface;

class GameWithoutCharacters
{
    /**
     * @return GameInterface
     */
    public static function get()
    {
        return new Game(new CharacterPool(), new HoneyPool(), \Yii::$app->params);
    }
}