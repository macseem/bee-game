<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/4/15
 * Time: 03:27
 */

namespace frontend\models\game\characters\interfaces;


use frontend\models\game\base\HoneyMakerInterface;
use frontend\models\game\characters\base\interfaces\BeeInterface;

interface WorkerInterface extends BeeInterface, HoneyMakerInterface
{

}