<?php

class GameColors
{
    private $colors = array();

    public function __construct(Configuration $configurationBackend)
    {
        $ini = $configurationBackend->readIniFile();
        $this->colors = $ini['colors'];
    }

    /**
     * @return array
     */
    public function getAllColors()
    {
        return $this->colors;
    }
}
