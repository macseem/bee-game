<?php
use frontend\models\game\base\BeeTypesInterface;

return [
    'gameConfig' => [
        BeeTypesInterface::BEE_TYPE_QUEEN  => 1,
        BeeTypesInterface::BEE_TYPE_HEALER => 2,
        BeeTypesInterface::BEE_TYPE_WORKER => 5,
        BeeTypesInterface::BEE_TYPE_DRONE  => 5,
    ]
];
