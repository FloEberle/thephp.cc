<?php

class Cube 
{
    /**
     *
     * @var array
     */
    private $colors = array();
    
    /**
     * 
     * @param array $colors
     */
    public function __construct($colors)
    {
        $this->colors = $colors;
    }
    
    /**
     * 
     * @return string
     */
    public function getRandomColor()
    {
        $random = rand(0, count($this->colors) - 1 );
        return $this->colors[$random];
    }
}