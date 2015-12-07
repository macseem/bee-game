<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/7/15
 * Time: 02:51
 */

namespace frontend\models\game\base;


use frontend\models\game\characters\base\interfaces\CharacterInterface;

interface GameStepInterface
{
    public function step(CharacterInterface $character);
}