<?php

class player
{
    /**
     *@var $name string 
     */
    public $name;
    public $cards = array();
    
    public function __construct($name)
    {
        $this->setName($name);
    }
    
    
    private function setName($name)
    {
        $this->name = $name;
    }
    
    public function getName()
    {
        return $this->name;
    }
}