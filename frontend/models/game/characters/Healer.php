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

    public function heal(BeeInterface $bee, HoneyPoolInterface $pool)
    {
        // TODO: Implement heal() method.
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
}