<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/5/15
 * Time: 03:07
 */

namespace frontend\models\game\base;


interface CharacterTypesInterface
{
    const BEE_TYPE_PLAYER = 'player';
    const BEE_TYPE_QUEEN = 'queen';
    const BEE_TYPE_HEALER = 'healer';
    const BEE_TYPE_WORKER = 'worker';
    const BEE_TYPE_DRONE = 'drone';

    const BEE_AVAILABLE_TYPES = [
        self::BEE_TYPE_PLAYER,
        self::BEE_TYPE_QUEEN,
        self::BEE_TYPE_HEALER,
        self::BEE_TYPE_WORKER,
        self::BEE_TYPE_DRONE,
    ];

}