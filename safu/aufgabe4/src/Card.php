<?php

class Card
{
    /**
     *
     * @var type string
     */
    private $color;
    
    /**
     * 
     * @param string $color
     */
    public function __construct($color)
    {
        $this->color = $color; 
    }
    
    /**
     * 
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }
    
    
}