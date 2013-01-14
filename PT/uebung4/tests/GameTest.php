<?php

class GameTest extends PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $this->configuration = new Configuration();
        $this->gameColors = new GameColors($this->configuration);
        $this->cube = new Cube($this->gameColors);
        $this->playerCollection = new PlayerCollection($this->configuration);
        $this->game = new Game(
            $this->configuration,
            $this->gameColors,
            $this->cube,
            $this->playerCollection);
    }

    public function testNewGameIsInstanceOfGame()
    {
        $this->assertInstanceOf('Game', $this->game);
    }
}
