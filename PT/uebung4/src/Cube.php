<?php

class Cube
{
    private $colors = array();

    public function __construct()
    {
        array_push($this->colors, 'red', 'yellow', 'blue', 'green', 'brown', 'violet');
    }

    public function roll()
    {
        $colorId = array_rand($this->colors, 1);
        return  $this->colors[$colorId];
    }

    public function getAllColors()
    {
        return $this->colors;
    }

    public function createPlayerCards($numberOfCards)
    {
        $cards = $this->colors;
        $random = rand(1, $numberOfCards);
        unset($cards[$random]);
        return $cards;
    }

}
