<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/5/15
 * Time: 01:31
 */

namespace frontend\models\game\characters;


use frontend\models\game\base\CharacterInterface;

class Player implements PlayerInterface
{

    private $lifespan = 500;

    public function getLifespan()
    {
        return $this->lifespan;
    }

    public function setLifespan($value)
    {
        if($value < $this->getLifespanMax())
            return $this->lifespan = $value;
        return $this->lifespan = $this->getLifespanMax();
    }

    public function beforeDead()
    {
        // TODO: Implement beforeDead() method.
    }

    public function beforeTakeHit()
    {
        // TODO: Implement beforeTakeHit() method.
    }

    public function takeHit($criticalPercent)
    {
        $this->setLifespan($this->getLifespan() - $this->getHitAmount($criticalPercent));
    }

    public function afterTakeHit()
    {
        // TODO: Implement afterTakeHit() method.
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

    public function toDie()
    {
        // TODO: Implement toDie() method.
    }

    private function getLifespanMax()
    {
        return 500;
    }

    function getHitAmount($criticalPercent)
    {
        return 20 + 20/100*$criticalPercent;
    }
}