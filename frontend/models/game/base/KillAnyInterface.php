<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/5/15
 * Time: 06:57
 */

namespace frontend\models\game\base;


interface KillAnyInterface extends KillAllInterface
{
    public function kill($id);
}