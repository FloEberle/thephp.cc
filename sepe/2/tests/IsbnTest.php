<?php

class UserTest extends PHPUnit_Framework_TestCase
{

    private $isbn;

    protected function setUp()
    {
        $this->isbn = new ISBN('978-3-446-23880-0');
    }

    public function testValidateIsbnWorks()
    {
        $this->assertEquals('978-3-446-23880-0',$this->isbn->getIsbn());
    }

    /**
     * @expectedException InvalidGroupException
     */
    public function testThrowsExceptionWhenISBNIsInvalid()
    {
        $isbn = new ISBN('978-9-446-23880-0');
    }
    /**
     * @expectedException InvalidChecksumException
     */
    public function testThrowsExceptionWhenChecksumIsInvalid()
    {
        $isbn = new ISBN('978-3-446-23880-9');
    }

    public function testIsbnIsEqual()
    {
        $isbn = ('978-3-446-23880-0');
        $this->assertTrue($this->isbn->isEqualTo($isbn));
    }

}