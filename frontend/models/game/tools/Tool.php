<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/7/15
 * Time: 02:49
 */

namespace frontend\models\game\tools;


use frontend\models\game\base\GameStepInterface;
use frontend\models\game\characters\base\interfaces\CharacterInterface;
use frontend\models\game\GameInterface;

abstract class Tool implements GameStepInterface
{
    private $game;
    public function __construct(GameInterface $game)
    {
        $this->game = $game;
    }

    protected function getGame()
    {
        return $this->game;
    }

    abstract public function step(CharacterInterface $character);
}