<?php

class cards 
{
    /**
     * @var $player Object
     */
    private $player; 
    
    /**
     * @var $rand integer
     */
    private $rand;
    
    public function __construct (player $player) 
    {
      $this->player = $player;
    }
    
    private function setCards ()
    {
        $this->rand = $this->randomCard();
        
        if($this->hasCard($this->rand)){
            while(!$this->hasCard($this->randomCard()))
            {
                
            }
        }
      
       
    }
    
    public function getCards ()
    {        
      return $this->player->cards;
    }
    
    private function randomCard ()
    {
       return $this->$rand = rand(1, 6); 
    }
    
    public function hasCard ($number)
    {
        if (array_key_exists($number, $this->player->cards)){
            return $this->player->cards[$number] = true;
        }
        
        return false;
    }
    
}