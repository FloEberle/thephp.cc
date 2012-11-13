<?php

class IsbnTest extends PHPUnit_Framework_TestCase
{
    private $isbn; 
    
  protected function setUp()
  {
      $this->isbn = new ISBN('978-3-86680-192-9');
  }  
}