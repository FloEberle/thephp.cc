<?php

class Player
{
    private $cards = array();
    private $numberOfCards;

    public function __construct(Cube $cube, $numberOfCards)
    {
        $this->numberOfCards = $numberOfCards;
        $this->cards = $cube->createPlayerCards($numberOfCards);
    }

    /**
     * @param $color
     * @return bool
     */
    public function hasCardColor($color)
    {
        return in_array($color, $this->cards);
    }

    public function removeCard($color)
    {
        foreach ($this->cards as $cardId) {
            if ($this->cards[$cardId] == $color){
                unset($this->cards[$cardId]);
            }
        }
    }
}



