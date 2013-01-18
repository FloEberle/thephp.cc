<?php

class Card
{
    private $turned = false;

    /**
     * @var string
     */
    private $color;

    public function __construct($color)
    {
        $this->color = $color;
    }

    public function turn()
    {
        $this->turned = true;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function isTurned()
    {
        return $this->turned;
    }

}
