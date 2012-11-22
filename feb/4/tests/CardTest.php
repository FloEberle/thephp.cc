<?php
class CardTest extends PHPUnit_Framework_TestCase
{
    private $card;
    private $color;

    public function setUp()
    {
        $this->color = 'GREEN';
        $this->card = new Card($this->color);
    }

    public function testGetColor()
    {
        $this->assertSame($this->color, $this->card->getColor());
    }
}