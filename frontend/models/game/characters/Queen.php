<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/5/15
 * Time: 02:48
 */

namespace frontend\models\game\characters;


use frontend\models\game\base\Bee;

class Queen extends Bee implements QueenInterface
{

    public function getType()
    {
        return self::BEE_TYPE_QUEEN;
    }

    function getHitAmount($criticalPercent)
    {
        return 8 + 8/100*$criticalPercent;
    }


    public function killAllBees()
    {
        $this->getCharacterPool()->killAllBees();
    }

    public function beforeTakeHit()
    {
        // TODO: Implement beforeTakeHit() method.
    }

    public function beforeDead()
    {
        $this->killAllBees();
    }

}