<?php

class GameColors
{
    private $colors = array();

    public function __construct(ConfigurationBackend $configurationBackend)
    {
        $ini = $configurationBackend->readIniFile();
        $this->colors = $ini['colors'];
    }

    public function getAllColors()
    {
        return $this->colors;
    }
}
