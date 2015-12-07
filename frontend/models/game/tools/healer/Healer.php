<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/7/15
 * Time: 03:01
 */

namespace frontend\models\game\tools\healer;


use frontend\models\game\base\AliveInterface;
use frontend\models\game\characters\base\interfaces\CharacterInterface;
use frontend\models\game\GameInterface;
use frontend\models\game\pools\interfaces\HoneyPoolInterface;
use frontend\models\game\tools\Tool;

class Healer extends Tool implements HealerInterface
{

    public function heal(AliveInterface $character, HoneyPoolInterface $pool)
    {
        // TODO: Implement heal() method.
    }

    public function step(CharacterInterface $character, GameInterface $game)
    {
        $this->heal($character, $game->getHoneyPool());
    }
}