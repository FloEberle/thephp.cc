<?php

/*
 * @-covers Player
 */
class PlayerTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->configuration = new Configuration();
        $this->gameColors = new GameColors($this->configuration);
        $this->cube = new Cube($this->gameColors);
        $this->playerCards = new PlayerCards($this->gameColors);
        $this->player = new Player($this->playerCards, 'Alice');
    }

    public function testHasCardColorWorks()
    {
        $this->assertTrue($this->player->hasCardColor('blue'));
        $this->assertFalse($this->player->hasCardColor('lilablassblau'));
    }

    public function testHasCards()
    {
        $this->assertTrue($this->player->hasCards());
    }

    public function testRemoveCardsWorks()
    {
        $this->player->removeCard('blue');
        $this->assertFalse($this->player->hasCardColor('blue'));
    }

    public function testGetNameReturnsName()
    {
        $this->assertEquals('Alice', $this->player->getName());
    }
}
