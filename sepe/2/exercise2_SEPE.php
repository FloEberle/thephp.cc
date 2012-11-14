<?php
/**
 * Uebungsaufgabe 2
 *
 */
$value1 = "978 9 86680 192 9";
$value2 = "978-3-86680-192-8";
$value3 = "978 3 86680 192 9";
$value4 = "978-3-86680-192-9";

$isbn1 = new ISBNValidator();
$isbn2 = new ISBNValidator();

$isbn1->validate($value1);
//$isbn2->validate($value2);

$isbn1->compare($value1,$value2);
$isbn2->compare($value3,$value4);

class ISBNValidator
{
    public function validate($isbn)
    {
        $isbn = $this->normalize($isbn);

        try {
            $this->validateGroup($isbn);
            $this->validateDigit($isbn);
            return true;
        }
        catch (Exception $e) {
            return false;
        }
    }

    private function normalize($isbn)
    {
        return str_replace(' ', '-', trim($isbn));
    }

    // Teilaufgabe a
    private function validateGroup($isbn)
    {
        $groups = array_merge(range(0,5),range(7,7),range(80,94),range(600,649),range(950,989),range(9900,9989),range(99900,99999));

        $isbnGroup = explode("-",$isbn);

        try {
            if (!in_array($isbnGroup[1],$groups)) {
                throw new InvalidArgumentException('Group not valid for ISBN ' . $isbn);
            }
        }
        catch (Exception $x) {
            echo 'Exception: ' . $x->getMessage() . ' on Line ' . $x->getLine() . ' in File  ' . $x->getFile() . "\n";
        }
    }

    private getDigit($isbn, $position)
    {
        return (int) substr($isbn, $position, $position + 1);
    }

    // Teilaufage b
    private function isChecksumValid($isbn)
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

        $checksum = ... $this->getDigit($isbn, 1) + $this->getDigit($isbn, 3) ...

        $digit = (10-(($z1 + $z3 + $z5 + $z7 + $z9 + $z11 + 3*($z2 + $z4 + $z6 + $z8 + $z10 + $z12))%10))%10;

        return ($checksum == $z13);
    }

    // Teilaufgabe c
    public function compare($a, $b)
    {
        $a = $this->normalize($a);
        $b = $this->normalize($b);

        if (strcmp($a,$b) !== 0) {
            echo 'Die ISBNs ' . $a . ' und ' . $b . ' sind nicht identisch' . "\n";
        }
        else {
            echo 'Die ISBNs ' . $a . ' und ' . $b . ' sind identisch' . "\n";
        }
    }
}