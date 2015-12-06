<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/4/15
 * Time: 03:32
 */

namespace frontend\models\game\base;


use frontend\models\game\characters\base\interfaces\CharacterInterface;

interface HitableInterface
{
    public function beforeHit();
    public function hit(CharacterInterface $character);
    public function afterHit();
}