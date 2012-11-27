<?php

class Configuration
{
    /**
     * @return array
     */
    public function readIniFile()
    {
        return parse_ini_file(__DIR__ . '/game.ini');
    }
}
