<?php

class Configuration
{
    /**
     * @var bool
     */
    private $loaded = false;

    /**
     * @var array
     */
    private $config = array();

    /**
     * @throws ConfigurationException
     */
    private function readIniFile()
    {
        $this->config = parse_ini_file(__DIR__ . '/game.ini');
        if (!$this->config){
            throw new ConfigurationException('config could not be loaded');
        }
        $this->loaded = true;
    }

    /**
     * @return array
     */
    public function getPlayers()
    {
        if (!$this->loaded){
            $this->readIniFile();
        }
        return $this->config['players'];
    }

    /**
     * @return array
     */
    public function getColors()
    {
        if (!$this->loaded){
            $this->readIniFile();
        }
        return $this->config['colors'];
    }
}
