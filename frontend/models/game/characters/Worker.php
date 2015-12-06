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
use frontend\models\game\characters\interfaces\WorkerInterface;

class Worker extends Bee implements WorkerInterface
{
    const HONEY_AMOUNT = 10;

    public function makeHoney(HoneyPoolInterface $honeyPool)
    {
        $honeyPool->bringHoney(self::HONEY_AMOUNT);
    }

    public function getType()
    {
        return self::BEE_TYPE_WORKER;
    }

    public function beforeTakeHit()
    {
        $this->makeHoney($this->getHoneyPool());
        return parent::beforeTakeHit();
    }
}