<?php

class Player
{
    /**
     *
     * @var string
     */
    private $name;
    
    /**
     *
     * @var array
     */
    private $cards = array();
    
    /**
     *
     * @var Cube
     */
    private $cube;

    public function __construct($name, Cube $cube)
    {
        $this->name = $name;
        $this->cube = $cube;
    }
    
    public function addCard(Card $card)
    {
        $this->cards[] = $card; 
    }
    
    public function play()
    {
        $color = $this->cube->getRandomColor();
        foreach($this->cards as $index => $card){
            if($color == $card->getColor()){
                unset($this->cards[$index]);
            }
        }
    }
    
    public function hasCards()
    {
        return count($this->cards) > 0;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
}