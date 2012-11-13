<?php

class IsbnTest extends PHPUnit_Framework_TestCase
{
    private $isbn;
    private $parts; 
    
  protected function setUp()
  {
      $this->isbn = new ISBN('978-3-86680-192-9');
      
      $isbnCode = '978-3-86680-192-9';
      if (strstr($isbnCode, '-') !== false) {
            $this->parts = explode('-', $isbnCode);
        } else {
            $this->parts = explode(' ', $isbnCode);
        }
  }  
  
  public function testSetIsbnWorks()
  {
    $this->assertEquals('0', $this->isbn->seIsbn('978-3-86680-192-9'));  
  }
  
  public function testGroupValidationWorks()
  {
     $this->assertEquals(true, $this->isbn->groupValidation($this->parts[1]));
  }
  
  public function testChecksumValidation()
  {
      $this->assertEquals(0, $this->isbn->checksumValidation(implode('', $this->parts)));
  }
}