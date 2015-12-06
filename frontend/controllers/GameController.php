<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/4/15
 * Time: 01:14
 */

namespace frontend\controllers;


use frontend\models\game\GameBuilder;
use frontend\models\game\GameBuilderInterface;
use frontend\models\game\GameInterface;
use frontend\models\game\GameStorageInterface;
use frontend\models\game\SessionStorage;
use yii\web\Controller;
use yii\web\Session;

class GameController extends Controller
{

    /** @var  GameStorageInterface */
    private $storage;
    /** @var  GameBuilderInterface */
    private $builder;
    /** @var  GameInterface */
    private $game;
    /** @var  Session */
    private $session;

    public function init()
    {
        $this->session = \Yii::$app->session;
        $this->storage = new SessionStorage($this->session);
        $this->builder = new GameBuilder(\Yii::$app->params['gameConfig'], \Yii::$app->params);
        $this->game = $this->getGame($this->storage, $this->builder);
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    private function getGame(GameStorageInterface $storage, GameBuilderInterface $builder)
    {
        if($game = $storage->get()){
            return $game;
        }
        return $builder->buildGame();
    }

    public function actionIndex()
    {
        return $this->render('index', ['game' => $this->game]);
    }

    public function actionStart()
    {
        if($this->game->isFinished())
            return $this->redirect('/game/finished');
        if($this->game->isStarted())
            return $this->redirect('/game/overview');
        $this->game->start();
        if($this->game->isStarted()){
            $this->session->set('started', true);
            $this->storage->save($this->game);
            return $this->redirect('/game/overview');
        }
    }

    public function actionOverview()
    {
        if(!$this->game->isStarted())
            return $this->redirect('/game/index');
        if($this->game->isFinished())
            return $this->redirect('/game/finished');
        return $this->render('overview', ['game' => $this->game]);
    }

    public function actionHit()
    {
        if(!$this->game->isStarted())
            return $this->redirect('/game/index');
        if($this->game->isFinished())
            return $this->redirect('/game/finished');
        $this->game->hit();
        $this->storage->save($this->game);
        if($this->game->isFinished())
            return $this->redirect('/game/finished');
        return $this->redirect('/game/overview', ['game' => $this->game]);
    }

    public function actionFinished()
    {
        if(!$this->game->isFinished())
            return $this->redirect('/game/overview');
        return $this->render('finished', ['game' => $this->game]);
    }

    public function actionQuit()
    {
        $this->session->offsetUnset('started');
        $this->storage->delete();
        return $this->redirect('/game/index');
    }
}