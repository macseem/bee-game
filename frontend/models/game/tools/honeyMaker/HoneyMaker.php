<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/7/15
 * Time: 03:06
 */

namespace frontend\models\game\tools\honeyMaker;


use frontend\models\game\characters\base\interfaces\CharacterInterface;
use frontend\models\game\pools\interfaces\HoneyPoolInterface;
use frontend\models\game\tools\Tool;

class HoneyMaker extends Tool implements HoneyMakerInterface
{

    public function make(HoneyPoolInterface $pool)
    {
        $pool->bringHoney($this->getGame()->getConfig()['tools']['honeyMaker']['amount']);
    }

    public function step(CharacterInterface $character)
    {
        $this->make($this->getGame()->getHoneyPool());
    }
}