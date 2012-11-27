<?php

class GameTest extends PHPUnit_Framework_TestCase
{
    private $game;
    
    public function setUp ()
    {
        $this->game = new Game();
        $this->game->setUp();    
    }
    
    public function testGameSetUpWorks () 
    {
        $this->assertArrayHasKey('1', $this->game->getPlayers());
    }
    
    public function testRunGameWorks ()
    {
        $this->game->run();
        $this->assertFalse($this->game->getGameStatus());
    }
    
    
}