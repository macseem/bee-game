<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/5/15
 * Time: 01:31
 */

namespace frontend\models\game\characters;


use frontend\models\game\base\CharacterInterface;
use frontend\models\game\BeeInterface;

class Player implements PlayerInterface
{

    public function getLifespan()
    {
        // TODO: Implement getLifespan() method.
    }

    public function setLifepan($value)
    {
        // TODO: Implement setLifepan() method.
    }

    public function beforeDead()
    {
        // TODO: Implement beforeDead() method.
    }

    public function beforeTakeHit()
    {
        // TODO: Implement beforeTakeHit() method.
    }

    public function takeHit()
    {
        // TODO: Implement takeHit() method.
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
        // TODO: Implement hit() method.
    }

    public function afterHit()
    {
        // TODO: Implement afterHit() method.
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
}