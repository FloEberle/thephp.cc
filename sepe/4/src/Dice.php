<?php

class Dice
{

    /**
     * @var array
     */
    private $colors = array (
        1 => 'red',
        2 => 'blue',
        3 => 'yellow',
        4 => 'green',
        5 => 'black',
        6 => 'white'
    );

    /**
     * @return string
     */
    public function getColor()
    {
        return $this->colors[rand(1,6)];
    }

}