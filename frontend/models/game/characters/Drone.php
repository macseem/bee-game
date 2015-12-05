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

    function getLifespanMax()
    {
        return 50;
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
        // TODO: Implement beforeTakeHit() method.
    }

    function afterTakeHit()
    {
        $this->beforeHit();
        $this->hit($this->getPlayer());
        $this->afterTakeHit();
    }

    public function toDie()
    {
        $this->setLifespan(0);
    }
}