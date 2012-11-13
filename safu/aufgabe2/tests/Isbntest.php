<?php

class IsbnTest extends PHPUnit_Framework_TestCase
{
    private $isbn; 
    
  public function testSetIsbnWorks()
  {                  
      $this->assertEquals('978-3-86680-192-9',  $this->isbn = new ISBN('978-3-86680-192-9'));
  }  
}