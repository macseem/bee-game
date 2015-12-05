<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/4/15
 * Time: 10:50
 */

namespace frontend\models\game;


use yii\web\Session;

class SessionStorage implements GameStorageInterface
{
    /** @var  Session */
    private $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function get()
    {
        if(empty($this->session->get('game')))
            return false;
        return unserialize($this->session->get('game'));
    }

    /**
     * @param GameInterface $game
     */
    public function save(GameInterface $game)
    {
        $this->session->set('game', serialize($game));
    }
}