<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/7/15
 * Time: 03:06
 */

namespace frontend\models\game\tools\honeyMaker;


use frontend\models\game\characters\base\interfaces\CharacterInterface;
use frontend\models\game\GameInterface;
use frontend\models\game\pools\HoneyPool;
use frontend\models\game\tools\Tool;

class HoneyMaker extends Tool implements HoneyMakerInterface
{

    public function make(HoneyPool $pool)
    {
        // TODO: Implement make() method.
    }

    public function step(CharacterInterface $character, GameInterface $game)
    {
        // TODO: Implement step() method.
    }
}