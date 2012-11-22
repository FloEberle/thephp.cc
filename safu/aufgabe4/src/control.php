<?php

class control
{
    
    public function __construct (player $player)
    {
      $this->checkCards($player->cards);  
    }
    
    private function checkCards(array $cards)
    {
        return !in_array(false, $cards);
    }
    
     public function setCardTrue ($number)
    {
        if (array_key_exists($number, $this->player->cards)){
            return $this->player->cards[$number] = true;
        }
        
        return false;
    }
}