<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/4/15
 * Time: 10:50
 */

namespace frontend\models\game;


class SessionStorage implements GameStorageInterface
{

    public function get()
    {
        return unserialize(\Yii::$app->session->get('game'));
    }

    /**
     * @param GameInterface $game
     * @return $gameId
     */
    public function add(GameInterface $game)
    {
        // TODO: Implement add() method.
    }

    public function update($gameId)
    {
        // TODO: Implement update() method.
    }

    public static function createFromGlobals()
    {
        // TODO: Implement createFromGlobals() method.
    }
}