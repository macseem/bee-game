<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/5/15
 * Time: 05:49
 */

namespace frontend\models\game\pools;


use frontend\models\game\pools\interfaces\HoneyPoolInterface;

class HoneyPool implements HoneyPoolInterface
{

    private $amount = 0;

    public function amount()
    {
        return $this->amount;
    }

    public function takeHoney($amount)
    {
        $amount = (int)$amount;
        if($amount>$this->amount)
            return false;
        $this->amount -= $amount;
        return true;
    }

    public function bringHoney($amount)
    {
        $this->amount+=(int)$amount;
    }
}