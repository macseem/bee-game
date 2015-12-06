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
use frontend\models\game\GameStorageInterface;
use frontend\models\game\SessionStorage;
use yii\web\Controller;

class GameController extends Controller
{

    /** @var  GameStorageInterface */
    private $storage;

    public function init()
    {
        $this->storage = new SessionStorage(\Yii::$app->session);
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

    public function actionIndex()
    {
        $game = $this->getGame(
            $this->storage,
            new GameBuilder(\Yii::$app->params['gameConfig'])
        );
        $game->hit();
        $this->storage->save($game);
        return $this->render('index', ['game' => $game]);
    }

    private function getGame(GameStorageInterface $storage, GameBuilderInterface $builder)
    {
        if($game = $storage->get()){
            return $game;
        }
        return $builder->buildGame();
    }

    public function actionRestart()
    {

    }
}