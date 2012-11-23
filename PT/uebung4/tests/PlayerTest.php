<?php

/*
 * @covers Player
 */
class PlayerTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->colorBackend = new ColorBackend();
        $this->gameColors = new GameColors($this->colorBackend);
        $this->cube = new Cube($this->gameColors);
        $this->playerCards = new PlayerCards($this->gameColors);
        $this->alice = new Player($this->playerCards, 'Alice');
    }

    public function testHasCardWorks()
    {
        $this->assertTrue($this->alice->hasCardColor('blue'));
        $this->assertFalse($this->alice->hasCardColor('lilablassblau'));
    }

    public function testRemoveCardsWorks()
    {
        $this->alice->removeCard('blue');
        $this->assertFalse($this->alice->hasCardColor('blue'));
    }
}
