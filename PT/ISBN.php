<?php

/*
$isbn = '978 3 86680 192 9';

$isbnValidator = new ISBN('978 3 86680 192 9');
$isIsbnValid = $isbnValidator->validate($isbn);
var_dump($isIsbnValid);
*/


class ISBN
{
    private $isbnGroupIdentifier;
    private $isbnPublisherCode;
    private $isbnItemNumber;
    private $isbnChecksum;
    private $isbn;

    public function __construct($isbn) {
        $this->validate($isbn);
        $this->isbn = $isbn;
    }

    /**
     * @param $isbn
     * @return bool
     */
    private function replaceSpacesWithHyphen($isbn) {
        return (str_replace(' ', '-', $isbn));
    }

    /**
     * @param $isbn
     * @return array
     */
    private function splitIsbn($isbn)
    {
        $isbn = $this->replaceSpacesWithHyphen($isbn);;
        $splittedIsbn = explode ("-", $isbn);
        return $splittedIsbn;
    }

    /**
     * @param $isbn
     * @return bool
     */
    private function hasExpectedLength($isbn)
    {
        return strlen($isbn) == 17;
    }

    /**
     * @param $isbn
     * @throws InvalidIsbnException
     */
    public function validate($isbn)
    {
        if (!$this->hasExpectedLength($isbn)) {
            throw new InvalidIsbnException('ISBN must be 17 characters');
        }

        if (!$this->isGroupIdentifierValid($isbn)) {
            throw new InvalidIsbnException('groupIdentifier is not valid');
        }

        if (!$this->isChecksumValid($isbn)) {
            throw new InvalidIsbnException('checksum is not valid');
        }
    }

    /**
     * @param $isbn
     * @return bool
     */
    private function isGroupIdentifierValid($isbn)
    {
        $isbn  = $this->replaceSpacesWithHyphen($isbn);
        $splittedIsbn = $this->splitIsbn($isbn);
        $groupIdentifier = $splittedIsbn[1];

        if(($groupIdentifier >= 0 && $groupIdentifier <= 5) || ($groupIdentifier = 7)
            || ($groupIdentifier >= 80 && $groupIdentifier <= 94)
            || ($groupIdentifier >= 600 && $groupIdentifier <= 649) || !($groupIdentifier >= 950 && $groupIdentifier <= 989)
            || ($groupIdentifier >= 9900 && $groupIdentifier <= 9989)
            || ($groupIdentifier >= 99900 && $groupIdentifier <= 99999)) {
            return true;
        }
        return false;
    }

    /**
     * @param $isbn
     * @return string
     */
    private function mergeIsbnForChecksumCalculation($isbn) {
        $mergedIsbn = str_replace('-', '', $isbn);
        return $mergedIsbn;
    }


    /**
     * @param $isbn
     * @return bool
     */
    private function isChecksumValid($isbn)
    {
        $isbn = $this->replaceSpacesWithHyphen($isbn);
        $compactIsbn = $this->mergeIsbnForChecksumCalculation($isbn);
        $sumIsbnUnevenPosition = 0;
        $sumIsbnEvenPosition = 0;

        for ($i = 0; $i < 12; $i +=2) {
            $sumIsbnUnevenPosition  += (int) substr($compactIsbn, $i, 1);
        }

        for ($i = 1; $i < 12; $i +=2) {
            $sumIsbnEvenPosition += (int) substr($compactIsbn, $i, 1);
        }

        $checksum = $sumIsbnUnevenPosition + 3 * $sumIsbnEvenPosition;
        $isbnChecksum = substr($compactIsbn, -1, 1);
        $calculatedChecksum = 10 - substr($checksum, -1, 1);

        if ($calculatedChecksum == 10)
        {
            $calculatedChecksum = 0;
        }

        if ($calculatedChecksum != $isbnChecksum)
        {
            return false;
        }

        return true;
    }
}

class InvalidIsbnException extends Exception
{

}
