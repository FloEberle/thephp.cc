<?php

class CardSetTest extends PHPUnit_Framework_TestCase
{
    private $cardSet;
    private $colors = [
        'red',
        'blue',
        'yellow',
        'green',
        'black',
        'white',
    ];
    private $player;
    private $dice;

    protected function setUp()
    {
        $this->cardSet = new CardSet($this->colors);
        $this->dice = new Dice($this->colors);
        $this->player = new Player('Alice', $this->dice, $this->cardSet);
    }

    public function testGetCardSetWorks()
    {
        $this->player->getCardSet();
        $this->assertEquals('5',$this->player-> getCountCards());
    }
}