<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/4/15
 * Time: 03:28
 */

namespace frontend\models\game\characters\interfaces;


use frontend\models\game\base\DoctorInterface;
use frontend\models\game\base\SearchBeeInterface;
use frontend\models\game\characters\base\interfaces\BeeInterface;

interface HealerInterface extends BeeInterface, DoctorInterface, SearchBeeInterface
{

}