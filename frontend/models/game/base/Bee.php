<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/4/15
 * Time: 03:03
 */

namespace frontend\models\game\base;


use frontend\models\game\characters\PlayerInterface;

abstract class Bee implements BeeInterface
{


    public function getLifespan()
    {
        // TODO: Implement getLifespan() method.
    }

    public function setLifepan($value)
    {
        // TODO: Implement setLifepan() method.
    }

    public function getQueen()
    {
        // TODO: Implement getQueen() method.
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

    /**
     * @return PlayerInterface
     */
    public function getPlayer()
    {
        // TODO: Implement getPlayer() method.
    }
}