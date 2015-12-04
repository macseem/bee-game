<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/4/15
 * Time: 03:32
 */

namespace frontend\models\game\base;


interface HitableInterface
{
    public function beforeHit(CharacterInterface $character);
    public function hit(CharacterInterface $character);
    public function afterHit(CharacterInterface $character);
}