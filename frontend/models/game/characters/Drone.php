<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/5/15
 * Time: 01:33
 */

namespace frontend\models\game\characters;


use frontend\models\game\base\Bee;
use frontend\models\game\base\CharacterInterface;

class Drone extends Bee implements DroneInterface
{


    public function getType()
    {
        return self::BEE_TYPE_DRONE;
    }

    public function beforeHit()
    {
        // TODO: Implement beforeHit() method.
    }

    public function hit(CharacterInterface $character)
    {
        $character->takeHit(0);
    }

    public function afterHit()
    {
        // TODO: Implement afterHit() method.
    }

    function getHitAmount($criticalPercent)
    {
        return 12 + 12/100*$criticalPercent;
    }

    public function beforeTakeHit()
    {
        $this->beforeHit();
        $this->getPlayer()->beforeTakeHit();
        $this->hit($this->getPlayer());
        $this->getPlayer()->afterTakeHit();
    }
}