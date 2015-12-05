<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/5/15
 * Time: 02:19
 */

namespace frontend\models\game\base;


use frontend\exceptions\FullPoolByTypeException;
use frontend\models\game\characters\PlayerInterface;

class CharacterPool implements CharacterPoolInterface
{

    /**
     * @var BeeInterface[]
     */
    private $bees = [];
    private $queen;
    /**
     * @var PlayerInterface
     */
    private $player;

    private $randomCallable;

    public function __construct($randomCallable = null)
    {
        $this->randomCallable = $randomCallable;
    }

    /**
     * @return BeeInterface[]
     */
    public function getBees()
    {
        return $this->bees;
    }

    public function setPlayer(PlayerInterface $player)
    {
        $this->player = $player;
    }

    public function addBee(BeeInterface $bee)
    {
        if($bee->getType() != BeeTypesInterface::BEE_TYPE_QUEEN){
            $this->bees[] = $bee;
            return true;
        }

        if(!empty($this->queen))
            throw new FullPoolByTypeException("Can't add 2 queens", 550);

        $this->bees[] = $bee;
        end($this->bees);
        $this->queen = key($this->bees);
        reset($this->bees);
        return true;

    }

    /**
     * @return PlayerInterface
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * @return BeeInterface
     */
    public function searchBee()
    {
        $max = count($this->bees)-1;
        if( $max <= 0)
            return false;
        if(is_callable($this->randomCallable))
            $number = call_user_func_array($this->randomCallable, [0,$max]);
        else $number = rand(0, $max);
        return $this->bees[$number];
    }

    public function killAll()
    {
        foreach($this->bees as $key => $bee) {
            $bee->beforeDead();
            $bee->toDie();
            $bee->setLifespan(0);
            unset($bee);
        }
    }
}