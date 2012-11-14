<?php

class UserTest extends PHPUnit_Framework_TestCase
{

    private $user;

    protected function setUp()
    {
        $this->user = new User();
    }

    public function testValidateIsbnWorks()
    {
        $this->assertEquals('978-3-446-23880-0',$this->isbn->getIsbn());
    }