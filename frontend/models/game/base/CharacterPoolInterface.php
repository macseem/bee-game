<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/5/15
 * Time: 02:08
 */

namespace frontend\models\game\base;


use frontend\models\game\characters\PlayerInterface;

interface CharacterPoolInterface extends SearchBeeInterface, GetPlayerInterface, KillAnyInterface
{
    /**
     * @return BeeInterface[]
     */
    public function getBees();

    public function setPlayer( PlayerInterface $player);

    public function addBee( BeeInterface $bee);


}