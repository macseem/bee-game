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
    const HEAL_VALUE = 3;

    public function heal(BeeInterface $bee, HoneyPoolInterface $pool)
    {
        if(!$pool->takeHoney(self::HEAL_COST))
            return false;
        return $bee->setLifespan($bee->getLifespan() + self::HEAL_VALUE);
    }

    /**
     * @return BeeInterface
     */
    public function searchBee()
    {
        return $this->getCharacterPool()->searchBee();
    }


    public function getType()
    {
        return self::BEE_TYPE_HEALER;
    }

    function getHitAmount($criticalPercent)
    {
        return 11 + 11/100*$criticalPercent;
    }

    public function beforeTakeHit()
    {
        $this->heal($this->searchBee(), $this->getHoneyPool());
    }


}