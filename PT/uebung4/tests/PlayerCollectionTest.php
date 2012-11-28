<?php

/*
 * @-covers PlayerCollection
 */
class PlayerCollectionTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $configuration = new Configuration();
        $gameColors = new GameColors($configuration);
        $this->cube = new Cube($gameColors);
        $this->playerCollection = new PlayerCollection($configuration);
        $this->cards = new PlayerCards($gameColors);
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
        $this->assertEquals(array('Bob', 'Alice', 'Carol'), $this->playerCollection->getPlayerNames());
    }
}
