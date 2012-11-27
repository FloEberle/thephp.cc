<?php

class CardTest extends PHPUnit_Framework_TestCase
{
    
   public function testSetColor(){
       $card = new Card('blue');
       $this->assertEquals('blue',$card->getColor());
   }
}