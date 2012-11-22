<?php

class GameColors
{
    private $colors = array();

    public function __construct(colorBackend $colorBackend)
    {
        $this->colors = $colorBackend->readIniFile();
    }

    public function getAllColors()
    {
        return $this->colors;
    }
}
