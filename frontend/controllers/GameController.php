<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/4/15
 * Time: 01:14
 */

namespace frontend\controllers;


use yii\web\Controller;

class GameController extends Controller
{

    public function actionIndex()
    {
        $session = \Yii::$app->session;
        return $this->render('index', $params);
    }

    public function actionRestart()
    {

    }
}