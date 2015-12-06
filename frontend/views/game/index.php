<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/4/15
 * Time: 02:46
 *
 * @var \frontend\models\game\GameInterface $game
 */

use yii\helpers\Html;
use yii\widgets\Pjax;
var_dump($game);
$config=[];
Pjax::begin($config);
echo Html::beginTag('a', ['href'=> '']); ?>
Hit bee
<? echo Html::endTag('a');
Pjax::end();