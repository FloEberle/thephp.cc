<?php

class cube 
{
    /**
     * @var rand integer
     */
    private $rand;
        
    private function getCube()
    {
        return $this->rand;
    }
 
    private function setCube()
    {
        $this->rand = rand(1, 6); 
    } 
}