<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/5/15
 * Time: 02:47
 */

namespace frontend\models\game\characters;


use frontend\models\game\base\Bee;
use frontend\models\game\base\BeeInterface;
use frontend\models\game\base\HoneyPoolInterface;

class Healer extends Bee implements HealerInterface
{
    const HEAL_COST = 5;

    public function heal(BeeInterface $bee, HoneyPoolInterface $pool)
    {
        if($pool->amount()<self::HEAL_COST)
            return false;
        $pool->takeHoney(self::HEAL_COST);
        $bee->setLifespan($bee->getLifespan() + $this->getHealValue());
    }

    /**
     * @return BeeInterface
     */
    public function searchBee()
    {
        // TODO: Implement searchBee() method.
    }

    public function toDie()
    {
        // TODO: Implement toDie() method.
    }

    public function getType()
    {
        return self::BEE_TYPE_HEALER;
    }

    function getLifespanMax()
    {
        return 60;
    }


    function getHitAmount($criticalPercent)
    {
        return 11 + 11/100*$criticalPercent;
    }

    public function beforeTakeHit()
    {
        // TODO: Implement beforeTakeHit() method.
    }

    public function afterTakeHit()
    {
        $this->heal($this->searchBee(), $this->getHoneyPool());
    }
}