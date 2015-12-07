<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/7/15
 * Time: 02:50
 */

namespace frontend\models\game\tools\hitter;


use frontend\models\game\base\HitTakerInterface;
use frontend\models\game\characters\base\interfaces\CharacterInterface;
use frontend\models\game\GameInterface;
use frontend\models\game\tools\Tool;

class Hitter extends Tool implements HitterInterface
{

    public function hit(HitTakerInterface $character, $criticalPercent)
    {
        $character->beforeTakeHit();
        $character->takeHit($criticalPercent);
        $character->afterTakeHit();
    }

    public function step(CharacterInterface $character, GameInterface $game)
    {
        return $this->hit($character, $this->getCriticalPercent());
    }

    private function getCriticalPercent()
    {
        //TODO: implement critical hit feature
        return 0;
    }
}