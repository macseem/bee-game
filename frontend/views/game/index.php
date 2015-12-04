<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/4/15
 * Time: 02:46
 */

use yii\helpers\Html;
use yii\widgets\Pjax;

$config=[];
Pjax::begin($config);
echo Html::beginTag('a', ['href'=> '']); ?>
Hit bee
<? echo Html::endTag('a');
Pjax::end();