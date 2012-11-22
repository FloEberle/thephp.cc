<?php

class Card
{
    private $color;

    /**
     * @param $color string
     */
    public function __construct($color)
    {
        $this->color = $color;
    }

    /**
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }
}
