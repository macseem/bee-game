<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/4/15
 * Time: 10:13
 */

namespace frontend\models\game\base;

use frontend\models\game\characters\base\interfaces\CharacterInterface;

interface SearchBeeInterface
{
    /**
     * @return CharacterInterface
     */
    public function searchBee();

}