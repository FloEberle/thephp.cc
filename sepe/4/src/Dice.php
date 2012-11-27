<?php

class Dice
{
    /**
     * @var array
     */
    private $colors;

    /**
     * @param array $colors
     */
    public function __construct(array $colors)
    {
        $this->colors = $colors;
    }

    /**
     * @return string
     */
    public function getColor()
    {
        return $this->colors[rand(1,6)];
    }

}