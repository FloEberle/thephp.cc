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
        return $this->cards;
    }

/**
     * @param $color
     */
    public function removeCard($color)
    {
        foreach ($this->cards as $index => $card) {
            if($color == $card) {
                // echo $this->name . ' legt ' . $color . ' weg' . PHP_EOL;
                unset($this->cards[$index]);
            }
        }
    }
}
