<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/4/15
 * Time: 10:04
 */

namespace frontend\models\game;


use frontend\models\game\base\HitTakerInterface;

interface GameInterface extends  HitTakerInterface
{

    public function init(GameStorageInterface $storage);

    public function isStarted();

    public function start();

    public function hit();//continue

    public function end();

    public function reset();


}