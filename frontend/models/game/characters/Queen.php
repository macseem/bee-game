<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/5/15
 * Time: 02:48
 */

namespace frontend\models\game\characters;


use frontend\models\game\characters\base\Bee;
use frontend\models\game\characters\interfaces\QueenInterface;

class Queen extends Bee implements QueenInterface
{

    public function getType()
    {
        return self::BEE_TYPE_QUEEN;
    }


    public function killAllBees()
    {
        $this->getCharacterPool()->killAllBees();
    }

    public function beforeDead()
    {
        $this->killAllBees();
    }

}