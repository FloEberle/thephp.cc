<?php

class UserTest extends PHPUnit_Framework_TestCase
{

    private $isbn;

    protected function setUp()
    {
        $this->isbn = new ISBN();
    }

    public function testValidateIsbnWorks()
    {
        $this->assertEquals('978-3-86680-192-9',$this->isbn->validate('978-3-86680-192-9'));
    }

}