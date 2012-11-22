<?php

class Cube
{
    private $colors = array();

    public function __construct(GameColors $gameColors)
    {
        $this->colors = $gameColors->getAllColors();
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
}
