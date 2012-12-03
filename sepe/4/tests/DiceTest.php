<?php

class DiceTest extends PHPUnit_Framework_TestCase
{

    private $dice;
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
    }

    public function testGetColorWorks()
    {
        $this->assertTrue(in_array($this->dice->getColor(), $this->colors));
    }

}