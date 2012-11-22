<?php

class Player
{
    private $cards = array();
    private $name;

    public function __construct(PlayerCards $playerCards, $numberOfCards, $name)
    {
        $this->name = $name;
        $this->cards = $playerCards->createPlayerCards($numberOfCards);
    }

    public function hasCardColor($color)
    {
        return in_array($color, $this->cards);
    }

    public function removeCard($color)
    {
        foreach ($this->cards as $cardId) {
            $this->cards = array_diff($this->cards, array($color));
        }
    }
}
