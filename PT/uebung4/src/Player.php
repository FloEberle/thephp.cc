<?php

class Player
{
    private $cards = array();
    private $numberOfCards = 5;

    public function __construct(Cube $cube)
    {
        $this->cards = $cube->createPlayerCards($this->numberOfCards);
    }
}
