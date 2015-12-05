<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/5/15
 * Time: 02:48
 */

namespace frontend\models\game\characters;


use frontend\models\game\base\Bee;

class Queen extends Bee implements QueenInterface
{

    public function toDie()
    {
        // TODO: Implement toDie() method.
    }

    public function killAll()
    {
        // TODO: Implement killAll() method.
    }

    public function getType()
    {
        return self::BEE_TYPE_QUEEN;
    }
}