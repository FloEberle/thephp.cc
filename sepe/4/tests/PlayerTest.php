<?php

class PlayerTest extends PHPUnit_Framework_TestCase
{

    private $colors = [
            'red',
            'blue',
            'yellow',
            'green',
            'black',
            'white',
            ];

    private $dice;
    private $cardSet;

    protected function setUp()
    {
        $this->dice = $this->getMockBuilder('Dice')
             ->disableOriginalConstructor()
             ->getMock();

        $this->cardSet = $this->getMockBuilder('CardSet')
             ->disableOriginalConstructor()
             ->getMock();

        new Player('Alice', $this->dice, $this->cardSet);
    }

    public function testRollDiceWorks()
    {

    }

}