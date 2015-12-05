<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/4/15
 * Time: 10:49
 */

namespace frontend\models\game;


use frontend\models\game\base\BeeInterface;
use frontend\models\game\base\CharacterPoolInterface;
use frontend\models\game\base\HoneyPoolInterface;
use frontend\models\game\characters\PlayerInterface;

class Game implements GameInterface
{
    private $characterPool;
    private $honeyPool;
    private $started;
    private $finished;
    private $time;
    private $result;

    public function __construct(CharacterPoolInterface $pool, HoneyPoolInterface $honeyPool)
    {
        $this->characterPool = $pool;
        $this->honeyPool = $honeyPool;
    }


    public function start()
    {
        $this->started = time();
    }

    public function hit()
    {
        $bee = $this->searchBee();
        $player = $this->getPlayer();
        $player->beforeHit();
        $bee->beforeTakeHit();
        $player->hit($bee);
        $bee->takeHit(0);
        $player->afterHit();
        $bee->afterTakeHit();
    }

    public function finish()
    {
        $this->finished = time();
        $this->time = $this->finished - $this->started;
    }

    public function reset()
    {
        $this->time = null;
        $this->started = null;
        $this->finished = null;
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
        $this->getCharacterPool()->searchBee();
    }

    public function isStarted()
    {
        return !empty($this->started);
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

    public function win()
    {
        $this->finish();
        $this->result = self::RESULT_WIN;
        return $this->result;
    }

    public function lose()
    {
        $this->finish();
        $this->result = self::RESULT_LOSE;
        return $this->result;
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
}