<?php

class Cube
{
    private $colors = array();

    public function __construct()
    {
        array_push($this->colors, 'red', 'yellow', 'blue', 'green', 'lilablassblau', 'piggypink');
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
        $cards = array();

        for ($i = 1; $i <= $numberOfCards; $i++){
            $currentColor = $this->roll();
            if (in_array($currentColor, $cards)) {
                $currentColor = $this->roll();
            }
            $cards[] = $currentColor;
        }
        return $cards;
    }

}
