<?php

class GameColors
{
    private $colors = array();

    public function __contruct()
    {
        $this->colors = parse_ini_file(__DIR__ . '/colors.ini');
    }

    public function getAllColors()
    {
        return $this->colors;
    }
}
