<?php
use frontend\models\game\base\BeeTypesInterface;
use frontend\models\game\characters\interfaces\PlayerInterface;

return [
    'gameConfig' => [
        BeeTypesInterface::BEE_TYPE_QUEEN  => 1,
        BeeTypesInterface::BEE_TYPE_HEALER => 3,
        BeeTypesInterface::BEE_TYPE_WORKER => 3,
        BeeTypesInterface::BEE_TYPE_DRONE  => 7,
    ],
    'maxLifespans' => [
        PlayerInterface::PLAYER_TYPE => 300,
        BeeTypesInterface::BEE_TYPE_QUEEN  => 100,
        BeeTypesInterface::BEE_TYPE_HEALER => 100,
        BeeTypesInterface::BEE_TYPE_WORKER => 60,
        BeeTypesInterface::BEE_TYPE_DRONE  => 50,
    ],
    'hitAmounts' => [
        PlayerInterface::PLAYER_TYPE => 20,
        BeeTypesInterface::BEE_TYPE_QUEEN  => 8,
        BeeTypesInterface::BEE_TYPE_HEALER => 10,
        BeeTypesInterface::BEE_TYPE_WORKER => 12,
        BeeTypesInterface::BEE_TYPE_DRONE  => 5,
    ]
];
