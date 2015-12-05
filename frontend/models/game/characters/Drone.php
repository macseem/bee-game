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

    public function toDie()
    {
        // TODO: Implement toDie() method.
    }

    public function getType()
    {
        return self::BEE_TYPE_DRONE;
    }
}