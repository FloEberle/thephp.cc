<?php
/**
 * Uebungsaufgabe 2
 *
 */

class ISBN
{
    private $isbn;

    public function __construct($isbn)
    {
        $this->setIsbn($isbn);
    }

    private function setIsbn($isbn)
    {
        $isbn = $this->normalize($isbn);
        $this->validateGroup($isbn);
        $this->validateChecksum($isbn);
        $this->isbn = $isbn;
    }

    private function normalize($isbn)
    {
        return str_replace(' ', '-', trim($isbn));
    }
    public function getIsbn()
    {
        return $this->isbn;
    }

    // Teilaufgabe a
    private function validateGroup($isbn)
    {
        $groups = array_merge(range(0,5),range(7,7),range(80,94),range(600,649),range(950,989),range(9900,9989),range(99900,99999));

        $isbnGroup = explode("-",$isbn);

        if (!in_array($isbnGroup[1],$groups)) {
            throw new InvalidGroupException('Group not valid for ISBN ' . $isbn);
        }
    }

    // Teilaufage b
    private function validateChecksum($isbn)
    {
        $isbn = str_replace('-', '', $isbn);

        $z1  = substr($isbn, 0, 1);
        $z2  = substr($isbn, 1, 1);
        $z3  = substr($isbn, 2, 1);
        $z4  = substr($isbn, 3, 1);
        $z5  = substr($isbn, 4, 1);
        $z6  = substr($isbn, 5, 1);
        $z7  = substr($isbn, 6, 1);
        $z8  = substr($isbn, 7, 1);
        $z9  = substr($isbn, 8, 1);
        $z10 = substr($isbn, 9, 1);
        $z11 = substr($isbn, 10, 1);
        $z12 = substr($isbn, 11, 1);
        $z13 = substr($isbn, 12, 1);

        $checksum = (10-(($z1 + $z3 + $z5 + $z7 + $z9 + $z11 + 3*($z2 + $z4 + $z6 + $z8 + $z10 + $z12))%10))%10;

        if ($checksum !== (int) $z13) {
            throw new InvalidChecksumException('Checksum not valid for ISBN ' . $isbn);
        }
    }

    // Teilaufgabe c
    public function isEqualTo($a)
    {
        $a = $this->normalize($a);

        if (strcmp( $a, $this->isbn) === 0) {
                return true;
        }
        else {
                return false;
        }
    }
}

class InvalidChecksumException extends InvalidArgumentException
{

}
class InvalidGroupException extends InvalidArgumentException
{

}