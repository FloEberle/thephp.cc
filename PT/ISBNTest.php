<?php

require 'ISBN.php';

Class ISBNTest extends PHPUnit_Framework_TestCase
{
    public function testValidIsbnWorks()
    {
        $this->assertInstanceOf('ISBN', new ISBN('978 3 86680 192 9'));
    }

    /**
     * @expectedException InvalidIsbnException
     */
    public function testInvalidLengthThrowsException()
    {
        $isbn = new ISBN('978 3 86680 192 9 123');
    }

    /**
     * @expectedException InvalidIsbnException
     */
    public function testInvalidCharacterThrowsException()
    {
        $isbn = new ISBN('978 3 86A80 192 9');
    }

    /**
     * @expectedException InvalidIsbnException
     */
    public function testInvalidGroupIdentifierThrowsExceptions()
    {
        $isbn = new ISBN('978 6 86680 192 9');
    }

    /**
     * @expectedException InvalidChecksumException
     */
    public function InvalidIsbnException()
    {
        $isbn = new ISBN('978 3 86680 192 1');
    }
}
