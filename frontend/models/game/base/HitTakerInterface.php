<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/4/15
 * Time: 03:16
 */

namespace frontend\models\game\base;


interface HitTakerInterface
{
    public function beforeTakeHit();
    public function takeHit();
    public function afterTakeHit();
}