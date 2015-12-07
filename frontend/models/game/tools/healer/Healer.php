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
use frontend\models\game\pools\interfaces\HoneyPoolInterface;
use frontend\models\game\tools\Tool;

class Healer extends Tool implements HealerInterface
{

    public function healRandomBee(AliveInterface $character, HoneyPoolInterface $pool)
    {
        if(!$pool->takeHoney($this->getGame()->getConfig()['tools']['healer']['cost']))
            return false;
        return $character->setLifespan($character->getLifespan() + $this->getGame()->getConfig()['tools']['healer']['value']);
    }

    public function step(CharacterInterface $character)
    {
        $bee = $this->getGame()->getCharacterPool()->searchBee();
        $this->healRandomBee($bee, $this->getGame()->getHoneyPool());
    }
}