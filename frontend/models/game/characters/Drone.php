<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/5/15
 * Time: 01:33
 */

namespace frontend\models\game\characters;


use frontend\models\game\characters\base\Bee;
use frontend\models\game\characters\base\interfaces\CharacterInterface;
use frontend\models\game\characters\interfaces\DroneInterface;

class Drone extends Bee implements DroneInterface
{


    public function getType()
    {
        return self::BEE_TYPE_DRONE;
    }

    public function hit(CharacterInterface $character)
    {
        $character->takeHit(0);
    }

    public function beforeTakeHit()
    {
        $this->getPlayer()->beforeTakeHit();
        $this->hit($this->getPlayer());
        $this->getPlayer()->afterTakeHit();
        return parent::beforeTakeHit();
    }
}