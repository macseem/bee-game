<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/4/15
 * Time: 03:03
 */

namespace frontend\models\game\characters\base;



use frontend\exceptions\ReadOnlyException;
use frontend\models\game\characters\base\interfaces\BeeInterface;

abstract class Bee extends Character implements BeeInterface
{

    private $id;

    public function setId($id)
    {
        if($this->id===null)
            return $this->id = $id;
        throw new ReadOnlyException("You can set Id only one time", 403);
    }
    public function getId()
    {
        return $this->id;
    }





    public function getPlayer()
    {
        return $this->getGame()->getPlayer();
    }

    public function getCharacterPool()
    {
        return $this->getGame()->getCharacterPool();
    }


    public function beforeDead()
    {
        return $this->getGame()->getCharacterPool()->kill($this->id);
    }

    /**
     * @return \frontend\models\game\pools\interfaces\HoneyPoolInterface
     */
    public function getHoneyPool()
    {
        return $this->getGame()->getHoneyPool();
    }

}