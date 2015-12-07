<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/7/15
 * Time: 03:07
 */

namespace frontend\models\game\tools\lazy;


use frontend\models\game\characters\base\interfaces\CharacterInterface;
use frontend\models\game\tools\Tool;

class Lazy extends Tool implements LazyInterface
{

    public function lazy()
    {
        // TODO: Implement lazy() method.
    }

    public function step(CharacterInterface $character)
    {
        $this->lazy();
    }
}