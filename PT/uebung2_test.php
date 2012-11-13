<?php

require 'uebung2_meins.php';

Class ISBNValidatorTest {

    public function setUp()
    {
        $this->ISBN = new isbnValidator('978 3 86680 192 9');
        $this->validGroupidentifier = 3;
        $this->invalidGroupIdentifier = 6;
        $this->validChecksum = 9;


    }

    public function testIsValidGroupIdentifier () {
        $this->assertTrue($this->ISBN->isValidGroupIdentifier($this->validGroupidentifier));
   }

    public function testIsInvalidGroupIdentifier () {
        $this->assertFalse($this->ISBN->isValidGroupIdentifier($this->invalidGroupidentifier));
    }

    public function testIsChecksumValid () {
        $this->assertTrue($this->ISBN->isChecksumValid($this->validChecksum));
    }





}
