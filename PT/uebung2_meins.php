<?php

$isbn = '978 3 86680 192 9';

$isbnValidator = new isbnValidator();
$isIsbnValid = $isbnValidator->validateIsbn($isbn);
var_dump($isIsbnValid);

class isbnValidator
{
    private $isbnGroupIdentifier;
    private $isbnPublisherCode;
    private $isbnItemNumber;
    private $isbnChecksum;

    private function replaceSpacesWithHyphen($isbn) {
        return (str_replace(' ', '-', $isbn));
    }

    private function splitIsbn($unsplittedIsbn)
    {
        $this->replaceSpacesWithHyphen($isbn);

        $splittedIsbn = explode ("-", $unsplittedIsbn);
        return $splittedIsbn;
    }

    public function validateIsbn($isbn)
    {
        $splittedIsbn = $this->splitIsbn($isbn);

        if (!$this->isValidGroupIdentifier($splittedIsbn[1])) {
            return false;
            throw new RuntimeException('...');
        }

        if (!$this->isChecksumValid($isbn)) {
            return false;
            throw new RuntimeException('...');
        }

        return true;
    }

    private function isValidGroupIdentifier($groupIdentifier)
    {
        if (strlen($groupIdentifier == 1))
        {
            if(($groupIdentifier >= 0 && $groupIdentifier <= 5) || ($groupIdentifier = 7)) {
                return true;
            }
        }

        if (strlen($groupIdentifier == 2))
        {
            if(($groupIdentifier >= 80 && $groupIdentifier <= 94)) {
                return true;
            }
        }

        if (strlen($groupIdentifier == 3))
        {
            if(($groupIdentifier >= 600 && $groupIdentifier <= 649) || !($groupIdentifier >= 950 && $groupIdentifier <= 989)) {
                return true;
            }
        }

        if (strlen($groupIdentifier == 4))
        {
            if(($groupIdentifier >= 9900 && $groupIdentifier <= 9989)) {
                return true;
            }
        }

        if (strlen($groupIdentifier == 5))
        {
            if(($groupIdentifier >= 99900 && $groupIdentifier <= 99999)) {
                return true;
            }
        }
        return false;
    }

    private function mergeIsbnForChecksumCalculation($isbn) {
        $mergedIsbn = str_replace('-', '', $isbn);
        return $mergedIsbn;
    }

    /**
     * @param $compactIsbn
     * @return bool
     */
    private function isChecksumValid($isbn)
    {
        $compactIsbn = str_replace('-', '', $isbn);

        for ($i = 0; $i < 12; i +=2) {
            $part1 = ...
        }

        for ($i = 1; $i < 12; i +=2) {
            $part2 = ...
        }

        $checksum = $part1 + 3 * $part2;

        // var_dump($mergedIsbn);
        $checksumCalculationSum =
              substr($compactIsbn, 0, 1)
            + substr($compactIsbn, 1, 1) * 3
            + substr($mergedIsbn, 2, 1)
            + substr($mergedIsbn, 3, 1) * 3
            + substr($mergedIsbn, 4, 1)
            + substr($mergedIsbn, 5, 1) * 3
            + substr($mergedIsbn, 6, 1)
            + substr($mergedIsbn, 7, 1) * 3
            + substr($mergedIsbn, 8, 1)
            + substr($mergedIsbn, 9, 1) * 3
            + substr($mergedIsbn, 10, 1)
            + substr($mergedIsbn, 11, 1) * 3;

        $isbnChecksum = substr($mergedIsbn, -1, 1);
        $calculatedChecksum = 10 - substr($checksumCalculationSum, -1, 1);

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
