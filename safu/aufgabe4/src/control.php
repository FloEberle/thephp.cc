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
}