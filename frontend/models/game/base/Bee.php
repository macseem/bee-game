<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/4/15
 * Time: 03:03
 */

namespace frontend\models\game\base;



use frontend\exceptions\ReadOnlyException;
use frontend\models\game\GameInterface;

abstract class Bee implements BeeInterface
{
    /** @var  GameInterface */
    private $game;
    private $lifespan;
    private $id;

    abstract public function getHitAmount($criticalPercent);

    final public function __construct(GameInterface $game)
    {
        $this->game = $game;
        $this->lifespan = $this->getLifespanMax();
        $this->init();
    }

    public function getLifespanMax()
    {
        return $this->game->getConfig()['maxLifespans'][$this->getType()];
    }

    public function setId($id)
    {
        if($this->id===null)
            return $this->id = $id;
        throw new ReadOnlyException("You can set Id only one time", 403);
    }
    public function getId()
    {
        return $this->id;
    }

    public function init() {}

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

    final public function afterTakeHit()
    {
        if($this->getLifespan() <=0 )
            $this->toDie();
    }


    public function beforeDead()
    {
        // TODO: Implement beforeDead() method.
    }


    final public function toDie()
    {
        $this->beforeDead();
        $this->game->getCharacterPool()->kill($this->id);
        $this->game->finish();
    }

    public function getHoneyPool()
    {
        return $this->game->getHoneyPool();
    }

}