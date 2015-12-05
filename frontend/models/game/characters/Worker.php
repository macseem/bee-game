<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/5/15
 * Time: 02:50
 */

namespace frontend\models\game\characters;


use frontend\models\game\base\Bee;
use frontend\models\game\base\HoneyPoolInterface;

class Worker extends Bee implements WorkerInterface
{

    public function toDie()
    {
        // TODO: Implement toDie() method.
    }

    public function makeHoney(HoneyPoolInterface $honeyPool)
    {
        // TODO: Implement makeHoney() method.
    }

    public function getType()
    {
        return self::BEE_TYPE_WORKER;
    }
}