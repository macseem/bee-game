<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/4/15
 * Time: 02:46
 *
 * @var \yii\web\View $this
 * @var \frontend\models\game\GameInterface $game
 */
echo $this->renderfile(__DIR__ . '/finishes/' . $game->getResult() . '.php');
