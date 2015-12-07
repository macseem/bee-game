<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/7/15
 * Time: 01:46
 */

namespace frontend\models\game\characters\base;


use frontend\models\game\characters\base\interfaces\CharacterInterface;
use frontend\models\game\GameInterface;

abstract class Character implements CharacterInterface
{
    /** @var  GameInterface */
    private $game;
    private $lifespan;

    final public function __construct(GameInterface $game)
    {
        $this->game = $game;
        $this->lifespan = $this->getLifespanMax();
        $this->init();
    }
    public function init() {}

    protected function getGame()
    {
        return $this->game;
    }

    public function getHitAmount($criticalPercent)
    {
        $amount = $this->game->getConfig()['hitAmounts'][$this->getType()];
        return  $amount + $amount/100*$criticalPercent;
    }

    public function getLifespanMax()
    {
        return $this->game->getConfig()['maxLifespans'][$this->getType()];
    }

    public function getLifespan()
    {
        return $this->lifespan;
    }

    /**
     * @param $value
     * @return int lifespan
     */
    public function setLifespan($value)
    {
        if($value < $this->getLifespanMax())
            return $this->lifespan = $value;
        return $this->lifespan = $this->getLifespanMax();
    }

    abstract public function getType();

    public function beforeTakeHit()
    {
        return true;
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

    abstract public function beforeDead();

    public function toDie()
    {
        $this->beforeDead();
        $this->game->finish();
    }

}