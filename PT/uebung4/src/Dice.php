<?php

class Dice
{
    /**
     * @var array
     */
    private $colors = array();

    public function __construct($colors)
    {
        $this->colors = $colors;
    }

    /**
     * @return string
     */
    public function roll()
    {
        $index = array_rand($this->colors, 1);
        return  $this->colors[$index];
    }
}
