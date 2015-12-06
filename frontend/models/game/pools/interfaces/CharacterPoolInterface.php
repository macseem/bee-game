<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/5/15
 * Time: 02:08
 */

namespace frontend\models\game\pools\interfaces;


use frontend\models\game\characters\base\interfaces\BeeInterface;
use frontend\models\game\base\GetPlayerInterface;
use frontend\models\game\base\KillAnyInterface;
use frontend\models\game\base\SearchBeeInterface;
use frontend\models\game\characters\interfaces\PlayerInterface;

interface CharacterPoolInterface extends SearchBeeInterface, GetPlayerInterface, KillAnyInterface
{
    /**
     * @return BeeInterface[]
     */
    public function getBees();

    public function setPlayer( PlayerInterface $player);

    public function addBee( BeeInterface $bee);


}