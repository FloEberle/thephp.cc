<?php

class Card
{
    /**
     * @var bool
     */
    private $turned = false;

    /**
     * @var string
     */
    private $color;

    public function __construct($color)
    {
        $this->color = $color;
    }

    /**
     * turns a Card, triggered by owning Player
     */
    public function turn()
    {
        $this->turned = true;
    }

    /**
     * @return string $color
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @return bool
     */
    public function isTurned()
    {
        return $this->turned;
    }

}
