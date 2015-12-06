<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/6/15
 * Time: 04:30
 */

namespace frontend\controllers;


use yii\web\Controller;

class ContactController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}