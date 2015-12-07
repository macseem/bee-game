<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/5/15
 * Time: 02:08
 */

namespace frontend\models\game\pools\interfaces;


use frontend\models\game\base\GetPlayerInterface;
use frontend\models\game\base\KillAnyInterface;
use frontend\models\game\base\SearchBeeInterface;
use frontend\models\game\characters\base\interfaces\CharacterInterface;

interface CharacterPoolInterface extends SearchBeeInterface, GetPlayerInterface, KillAnyInterface
{
    /**
     * @return CharacterInterface[]
     */
    public function getBees();

    public function setPlayer( CharacterInterface $player);

    public function addBee( CharacterInterface $bee);


}