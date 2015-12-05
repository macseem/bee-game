<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/4/15
 * Time: 03:03
 */

namespace frontend\models\game\base;



use frontend\models\game\GameInterface;

abstract class Bee implements BeeInterface
{
    /** @var  GameInterface */
    private $game;
    private $lifespan;


    abstract public function getLifespanMax();

    abstract public function getHitAmount($criticalPercent);

    public function __construct(GameInterface $game)
    {
        $this->lifespan = $this->getLifespanMax();
        $this->game = $game;
    }

    public function getPlayer()
    {
        return $this->game->getPlayer();
    }

    public function getCharacterPool()
    {
        return $this->game->getCharacterPool();
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

    abstract public function beforeTakeHit();

    public function takeHit($criticalPercent)
    {
        $this->setLifespan($this->getLifespan() - $this->getHitAmount($criticalPercent));
    }

    abstract public function afterTakeHit();


    public function beforeDead()
    {
        // TODO: Implement beforeDead() method.
    }


    public function toDie()
    {
        $this->setLifespan(0);
    }

    public function getHoneyPool()
    {
        return $this->game->getHoneyPool();
    }

}