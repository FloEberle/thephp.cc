<?php

class Player
{
    private $cards = array();
    private $name;

    public function __construct(PlayerCards $playerCards , $name)
    {
        $this->name = $name;
        $this->cards = $playerCards->createPlayerCards();
    }

    public function getName()
    {
        return $this->name;
    }

    public function hasCardColor($color)
    {
        return in_array($color, $this->cards);
    }

    public function hasCards()
    {
        return $this->cards;
    }

    public function removeCard($color)
    {
        foreach ($this->cards as $index => $card) {
            if($color == $card)
            {
                echo $this->name . ' legt ' . $color . ' weg' . PHP_EOL;
                unset($this->cards[$index]);
            }
        }
    }
}
