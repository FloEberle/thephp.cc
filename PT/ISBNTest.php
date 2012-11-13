<?php

require 'uebung2_meins.php';

Class uebung2_test
{
    private $ISBNNr;
    private $validGroupidentifier;
    private $invalidGroupIdentifier;
    private $validChecksum;

    public function setUp()
    {
        $this->ISBNNr = new isbnValidator('978 3 86680 192 9');
        $this->validGroupidentifier = 3;
        $this->invalidGroupIdentifier = 6;
        $this->validChecksum = 9;
    }

    public function testValidateISBNWorks() {
        $this->assertTrue($this->ISBNNr);

    }


    /**
    public function testIsGroupIdentifierValid () {
        $this->assertTrue($this->ISBN->isValidGroupIdentifier($this->validGroupidentifier));
   }

    public function testIsInvalidGroupIdentifier () {
        $this->assertFalse($this->ISBN->isValidGroupIdentifier($this->invalidGroupidentifier));
    }

    public function testIsChecksumValid () {
        $this->assertTrue($this->ISBN->isChecksumValid($this->validChecksum));
    }

    public function mergeIsbnForChecksumCalculationWorks () {
        $this->assertEqual('978 3 86680 192 9', $this->ISBN->mergeIsbnForChecksumCalculation($this->ISBN));
    }
    */

}
