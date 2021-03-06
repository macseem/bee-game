<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/5/15
 * Time: 01:31
 */

namespace frontend\models\game\characters;


use frontend\models\game\characters\base\Character;
use frontend\models\game\characters\base\interfaces\CharacterInterface;
use frontend\models\game\characters\interfaces\PlayerInterface;

class Player extends Character implements PlayerInterface
{

    public function getType()
    {
        return self::PLAYER_TYPE;
    }

    public function hit(CharacterInterface $character)
    {
        $character->beforeTakeHit();
        $character->takeHit(0);
        $character->afterTakeHit();

    }

    public function beforeDead()
    {
        $this->getGame()->getCharacterPool()->killPlayer();
    }
}