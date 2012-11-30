<?php

class CardGeneratorTest extends PHPUnit_Framework_TestCase
{
    private $cardSet;
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
        $this->cardSet = new CardSet($this->colors);
    }

    public function testGetCardSetWorks()
    {

    }

    public function testHasColorWorks()
    {

    }

}