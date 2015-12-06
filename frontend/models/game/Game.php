<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/4/15
 * Time: 10:49
 */

namespace frontend\models\game;


use frontend\exceptions\AlreadyStartedGameException;
use frontend\exceptions\CannotStartWithoutCharacterException;
use frontend\exceptions\FinishedGameException;
use frontend\exceptions\NotStartedGameException;
use frontend\models\game\base\BeeInterface;
use frontend\models\game\base\HoneyPoolInterface;
use frontend\models\game\pools\interfaces\CharacterPoolInterface;
use frontend\models\game\characters\interfaces\PlayerInterface;

class Game implements GameInterface
{
    private $config;
    private $characterPool;
    private $honeyPool;
    private $started;
    private $finished;
    private $time;
    private $result;

    public function __construct(CharacterPoolInterface $pool, HoneyPoolInterface $honeyPool, array $config)
    {
        $this->characterPool = $pool;
        $this->honeyPool = $honeyPool;
        $this->config = $config;
    }


    public function hit()
    {
        if(!$this->isStarted())
            throw new NotStartedGameException("You should start game first", 550);
        if($this->isFinished())
            throw new FinishedGameException("You've already finish. Restart game for hitting", 550);
        $bee = $this->searchBee();
        $player = $this->getPlayer();

        $player->beforeHit();
        $bee->beforeTakeHit();

        $player->hit($bee);
        $bee->takeHit(0);

        $player->afterHit();
        $bee->afterTakeHit();
    }

    /**
     * @return PlayerInterface
     */
    public function getPlayer()
    {
        return $this->getCharacterPool()->getPlayer();
    }

    /**
     * @return BeeInterface
     */
    public function searchBee()
    {
        return $this->getCharacterPool()->searchBee();
    }

    public function start()
    {
        if($this->isStarted())
            throw new AlreadyStartedGameException("This game has been already started.", 550);
        if(empty($this->getPlayer()) || empty($this->getCharacterPool()->getBees()))
            throw new CannotStartWithoutCharacterException("Some characters weren't provided by Builder", 550);
        $this->started = time();
    }

    public function isStarted()
    {
        return !empty($this->started);
    }

    public function finish()
    {
        if(!$this->isStarted() || (!empty($this->getCharacterPool()->getBees()) && !empty($this->getPlayer()))) {
            return false;
        }
        $this->finished = time();
        $this->time = $this->finished - $this->started;
        if(empty($this->getCharacterPool()->getPlayer()) && empty($this->getCharacterPool()->getBees()))
            return $this->setDrawResult();
        if(empty($this->getCharacterPool()->getPlayer()))
            return $this->setLoseResult();
        return $this->setWinResult();
    }

    public function isFinished()
    {
        return !empty($this->finished);
    }

    /**
     * @return int
     */
    public function gameTime()
    {
        return $this->time;
    }

    public function getResult()
    {
        if(!$this->isFinished())
            return false;
        return $this->result;
    }

    public function setWinResult()
    {
        return $this->result = self::RESULT_WIN;
    }

    public function setLoseResult()
    {
        return $this->result = self::RESULT_LOSE;
    }

    public function setDrawResult()
    {
        return $this->result = self::RESULT_DRAW;
    }

    /**
     * @return CharacterPoolInterface
     */
    public function getCharacterPool()
    {
        return $this->characterPool;
    }

    /**
     * @return HoneyPoolInterface
     */
    public function getHoneyPool()
    {
        return $this->honeyPool;
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }
}