<?php

class PlayerTest extends PHPUnit_Framework_TestCase
{

    private $colors = [
        'red',
    ];

    private $player;
    private $dice;
    private $cardSet;
    private $cards;

    protected function setUp()
    {
        $this->cards = $this->colors;

        $this->dice = $this->getMockBuilder('Dice')
             ->disableOriginalConstructor()
             ->getMock();

        $this->dice->expects($this->any())
                   ->method('getColor')
                   ->will($this->returnValue('red'));

        $this->cardSet = $this->getMockBuilder('CardSet')
             ->disableOriginalConstructor()
             ->getMock();

        $this->cardSet->expects($this->once())
             ->method('getCardSet')
            ->will($this->returnValue($this->colors));

        $this->player = new Player('Alice', $this->dice, $this->cardSet);
        $this->player->getCardSet();
    }

    public function testRollDiceWorks()
    {
        $this->assertEquals('red', $this->player->rollDice());
    }

    public function testGetNameWorks()
    {
        $this->assertEquals('Alice',$this->player->getName());
    }

    public function testHasColorWorks()
    {
        $this->assertTrue($this->player->hasColor($this->colors[0]));
        $this->assertFalse($this->player->hasColor('green'));
    }

    public function testTurnCardWorks()
    {
        $this->assertTrue($this->player->hasColor('red'));
        $this->player->turnCard('red');
        $this->assertFalse($this->player->hasColor('red'));
    }

    /**
     * @expectedException PlayerException
     * @expectedExceptionCode PlayerException::PLAYER_DOES_NOT_HAVE_THIS_COLOR
     */
    public function testTurnCardThrowsException()
    {
        $this->player->turnCard('green');
    }
}