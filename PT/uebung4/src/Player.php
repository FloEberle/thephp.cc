<?php

class Player
{
    private $cards = array();
    private $name;

    public function __construct(PlayerCards $playerCards, $name)
    {
        $this->name = $name;
        $this->cards = $playerCards->createPlayerCards();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $color
     * @return bool
     */
    public function hasCardColor($color)
    {
        return in_array($color, $this->cards);
    }

    /**
     * @return array
     */
    public function hasCards()
    {
        return count($this->cards) > 0;
    }

/**
     * @param $color
     */
    public function removeCard($color)
    {
        foreach ($this->cards as $index => $card) {
            if($color == $card) {
                unset($this->cards[$index]);
            }
        }
    }
}
