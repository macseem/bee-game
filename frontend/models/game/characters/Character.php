<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/7/15
 * Time: 01:46
 */

namespace frontend\models\game\characters;


use frontend\exceptions\ReadOnlyException;
use frontend\models\game\base\GameStepInterface;
use frontend\models\game\characters\base\interfaces\CharacterInterface;
use frontend\models\game\GameInterface;

class Character implements CharacterInterface
{
    private $id;
    private $type;
    /** @var  GameInterface */
    private $game;
    private $lifespan;
    private $tool;

    final public function __construct($type, GameInterface $game, GameStepInterface $tool)
    {
        $this->type = $type;
        $this->game = $game;
        $this->tool = $tool;
        $this->lifespan = $this->getLifespanMax();
        $this->init();
    }
    public function init() {}

    protected function getGame()
    {
        return $this->game;
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

    public function getType() {
        return $this->type;
    }

    public function takeHit($criticalPercent)
    {
        $this->setLifespan($this->getLifespan() - $this->getHitAmount($criticalPercent));
        if($this->getLifespan() <=0 )
            $this->toDie();
    }

    public function beforeDead()
    {
        if($this->getType() == self::BEE_TYPE_PLAYER)
            return $this->getGame()->getCharacterPool()->killPlayer();
        if($this->getType() == self::BEE_TYPE_QUEEN)
            return $this->getGame()->getCharacterPool()->killAllBees();
        return $this->getGame()->getCharacterPool()->kill($this->id);
    }

    public function toDie()
    {
        $this->beforeDead();
        $this->game->finish();
    }

    public function step(CharacterInterface $character)
    {
        return $this->tool->step($character);
    }
}