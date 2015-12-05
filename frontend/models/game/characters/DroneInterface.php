<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/4/15
 * Time: 03:28
 */

namespace frontend\models\game\characters;


use frontend\models\game\base\HitableInterface;
use frontend\models\game\base\BeeInterface;

interface DroneInterface extends BeeInterface, HitableInterface
{

}