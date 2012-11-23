<?php

class GameColors
{
    private $colors = array();

    public function __construct(colorBackend $colorBackend)
    {
        $ini = $colorBackend->readIniFile();
        $this->colors = $ini['colors'];

    }

    public function getAllColors()
    {
        return $this->colors;
    }
}
