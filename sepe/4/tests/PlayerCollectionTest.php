<?php

class PlayerCollectionTest extends PHPUnit_Framework_TestCase
{
    private $playerCollection;
    private $dice;
    private $cardSet;
    private $player;
    private $colors = [
        'red',
        'blue',
        'yellow',
        'green',
        'black',
        'white'
    ];

    protected function setUp()
    {
        $this->dice = new Dice($this->colors);
        $this->cardSet = new CardSet($this->colors);
        $this->player = new Player('Alice', $this->dice, $this->cardSet);
        $this->playerCollection = new PlayerCollection();
    }

    public function testAddingPlayerWorks()
    {
        $this->playerCollection->addPlayer($this->player);
        $this->assertTrue(in_array($this->player, $this->playerCollection->getPlayers()));
    }

}