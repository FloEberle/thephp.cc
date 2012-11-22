<?php

class ColorBackend
{
    private $inifile;

    public function readIniFile()
    {
        return parse_ini_file(__DIR__ . '/colors.ini');
    }
}
