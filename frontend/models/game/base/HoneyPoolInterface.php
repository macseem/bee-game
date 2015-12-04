<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/4/15
 * Time: 09:45
 */

namespace frontend\models\game\base;


interface HoneyPoolInterface
{
    public function amount();

    public function takeHoney($amount);

    public function bringHoney($amount);
}