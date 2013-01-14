<?php

/*
 * @-covers PlayerCollection
 */
class PlayerCollectionTest extends PHPUnit_Framework_TestCase
{
    private $configuration;
    private $gameColors;
    private $cube;
    private $playerCollection;
    private $cards;

    public function setUp()
    {
        $this->configuration = new Configuration();
        $this->gameColors = new GameColors($this->configuration);
        $this->cube = new Cube($this->gameColors);
        $this->playerCollection = new PlayerCollection($this->configuration);
        $this->cards = new PlayerCards($this->gameColors);
    }

    public function testNewPlayerCollectionIsInstanceOfPlayerCollection()
    {
        $this->assertInstanceOf('PlayerCollection', $this->playerCollection);
    }

    public function testAddPlayerWorks()
    {
        $newPlayer = new Player($this->cards, 'Nachzügler');
        $this->playerCollection->add($newPlayer);
        $this->assertTrue(in_array($newPlayer, $this->playerCollection->getPlayers()));
    }


    public function testGetPlayerNamesReturnsPlayerNames()
    {
        $ini = $this->configuration->readIniFile();
        foreach ($ini['players'] as $name){
            $this->playerCollection->add(new Player(new PlayerCards($this->gameColors), $name));
        }
        $this->assertEquals(array('Bob', 'Alice', 'Carol'), $this->playerCollection->getPlayerNames());
    }
}

