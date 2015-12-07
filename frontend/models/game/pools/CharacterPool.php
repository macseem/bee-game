<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/5/15
 * Time: 02:19
 */

namespace frontend\models\game\pools;


use frontend\exceptions\FullPoolByTypeException;
use frontend\models\game\base\CharacterTypesInterface;
use frontend\models\game\characters\base\interfaces\CharacterInterface;
use frontend\models\game\pools\interfaces\CharacterPoolInterface;

class CharacterPool implements CharacterPoolInterface
{

    /**
     * @var CharacterInterface[]
     */
    private $bees = [];
    private $queen;
    /**
     * @var CharacterInterface
     */
    private $player;

    private $randomCallable;

    public function __construct($randomCallable = null)
    {
        $this->randomCallable = $randomCallable;
    }

    /**
     * @return CharacterInterface[]
     */
    public function getBees()
    {
        return $this->bees;
    }

    public function setPlayer(CharacterInterface $player)
    {
        $this->player = $player;
    }

    public function addBee(CharacterInterface $bee)
    {
        if($bee->getType() != CharacterTypesInterface::BEE_TYPE_QUEEN){
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
     * @return CharacterInterface
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * @return CharacterInterface
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