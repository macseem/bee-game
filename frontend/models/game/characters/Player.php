<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/5/15
 * Time: 01:31
 */

namespace frontend\models\game\characters;


use frontend\models\game\characters\base\interfaces\CharacterInterface;
use frontend\models\game\GameInterface;
use frontend\models\game\characters\interfaces\PlayerInterface;

class Player implements PlayerInterface
{


    /** @var  GameInterface */
    private $game;
    private $lifespan;

    public function __construct(GameInterface $game)
    {
        $this->game = $game;
        $this->lifespan = $this->getLifespanMax();
    }

    public function getLifespan()
    {
        return $this->lifespan;
    }

    public function setLifespan($value)
    {
        if($value < $this->getLifespanMax())
            return $this->lifespan = $value;
        return $this->lifespan = $this->getLifespanMax();
    }

    public function beforeDead()
    {
        // TODO: Implement beforeDead() method.
    }

    public function beforeTakeHit()
    {
        // TODO: Implement beforeTakeHit() method.
    }

    public function takeHit($criticalPercent)
    {
        $this->setLifespan($this->getLifespan() - $this->getHitAmount($criticalPercent));
    }

    public function afterTakeHit()
    {
        if($this->getLifespan() <=0 )
            $this->toDie();
    }

    public function beforeHit()
    {
        // TODO: Implement beforeHit() method.
    }

    public function hit(CharacterInterface $character)
    {
        $character->takeHit(0);
    }

    public function afterHit()
    {
        // TODO: Implement afterHit() method.
    }

    public function toDie()
    {
        $this->beforeDead();
        $this->game->getCharacterPool()->killPlayer();
        $this->game->finish();
    }

    public function getLifespanMax()
    {
        return $this->game->getConfig()['maxLifespans'][$this->getType()];
    }

    public function getHitAmount($criticalPercent)
    {
        $amount = $this->game->getConfig()['hitAmounts'][$this->getType()];
        return  $amount + $amount/100*$criticalPercent;
    }

    public function getType()
    {
        return self::PLAYER_TYPE;
    }
}