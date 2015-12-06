<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/4/15
 * Time: 03:27
 */

namespace frontend\models\game\interfaces\characters;


use frontend\models\game\base\HoneyMakerInterface;
use frontend\models\game\base\BeeInterface;

interface WorkerInterface extends BeeInterface, HoneyMakerInterface
{

}