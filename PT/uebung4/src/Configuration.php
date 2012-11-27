<?php

class Configuration
{
    public function readIniFile()
    {
        return parse_ini_file(__DIR__ . '/game.ini');
    }
}
