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

    /**
     * 
     * @param string $name
     * @param Cube $cube
     */
    public function __construct($name, Cube $cube)
    {
        $this->name = $name;
        $this->cube = $cube;
    }
    
    /**
     * 
     * @param Card $card
     */
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
    
    /**
     * 
     * @return boolean
     */
    public function hasCards()
    {
        return count($this->cards) > 0;
    }
    
    /**
     * 
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    
}