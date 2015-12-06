<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/5/15
 * Time: 02:19
 */

namespace frontend\models\game\pools;


use frontend\exceptions\FullPoolByTypeException;
use frontend\models\game\base\BeeInterface;
use frontend\models\game\base\BeeTypesInterface;
use frontend\models\game\pools\interfaces\CharacterPoolInterface;
use frontend\models\game\characters\interfaces\PlayerInterface;

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
            end($this->bees);
            $bee->setId(key($this->bees));
            reset($this->bees);
            return true;
        }

        if(!empty($this->queen))
            throw new FullPoolByTypeException("Can't add 2 queens", 550);

        $this->bees[] = $bee;
        end($this->bees);
        $this->queen = key($this->bees);
        $bee->setId($this->queen);
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
        if( $max < 0)
            return false;
        if(is_callable($this->randomCallable))
            $number = call_user_func_array($this->randomCallable, [0,$max]);
        else $number = rand(0, $max);
        $keys = array_keys($this->bees);
        return $this->bees[$keys[$number]];
    }

    public function killAllBees()
    {
        $this->bees=[];
    }

    public function kill($id)
    {
        if(!isset($this->bees[$id]))
            return false;
        unset($this->bees[$id]);
        return true;
    }

    public function killPlayer()
    {
        unset($this->player);
    }
}