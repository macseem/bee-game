<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/4/15
 * Time: 22:17
 */
use frontend\models\game\base\CharacterTypesInterface;

return [
    'params' =>  [
        'gameConfig' => [
            CharacterTypesInterface::BEE_TYPE_QUEEN  => 1,
            CharacterTypesInterface::BEE_TYPE_HEALER => 1,
            CharacterTypesInterface::BEE_TYPE_WORKER => 1,
            CharacterTypesInterface::BEE_TYPE_DRONE  => 1,
        ],
        'maxLifespans' => [
            CharacterTypesInterface::BEE_TYPE_PLAYER => 300,
            CharacterTypesInterface::BEE_TYPE_QUEEN  => 100,
            CharacterTypesInterface::BEE_TYPE_HEALER => 100,
            CharacterTypesInterface::BEE_TYPE_WORKER => 60,
            CharacterTypesInterface::BEE_TYPE_DRONE  => 50,
        ],
        'hitAmounts' => [
            CharacterTypesInterface::BEE_TYPE_PLAYER => 20,
            CharacterTypesInterface::BEE_TYPE_QUEEN  => 8,
            CharacterTypesInterface::BEE_TYPE_HEALER => 10,
            CharacterTypesInterface::BEE_TYPE_WORKER => 12,
            CharacterTypesInterface::BEE_TYPE_DRONE  => 5,
        ],
        'characterTools' => [
            CharacterTypesInterface::BEE_TYPE_PLAYER       => \frontend\models\game\tools\hitter\Hitter::class,
            CharacterTypesInterface::BEE_TYPE_QUEEN  => \frontend\models\game\tools\lazy\Lazy::class,
            CharacterTypesInterface::BEE_TYPE_HEALER => \frontend\models\game\tools\healer\Healer::class,
            CharacterTypesInterface::BEE_TYPE_WORKER => \frontend\models\game\tools\honeyMaker\HoneyMaker::class,
            CharacterTypesInterface::BEE_TYPE_DRONE  => \frontend\models\game\tools\hitter\Hitter::class,
        ],
        'tools' => [
            'healer' => [
                'cost' => 5,
                'value' => 20
            ],
            'honeyMaker' => [
                'amount' => 10
            ]
        ]
    ]
];