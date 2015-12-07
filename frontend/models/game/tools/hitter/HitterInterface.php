<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/7/15
 * Time: 02:50
 */

namespace frontend\models\game\tools\hitter;


use frontend\models\game\base\HitTakerInterface;

interface HitterInterface
{
    public function hit(HitTakerInterface $character, $criticalPercent);
}