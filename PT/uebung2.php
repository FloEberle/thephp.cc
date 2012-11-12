<?php


$isbn = '978 3 86680 192 9';

$isbnValidator = new ISBNValidator();

if ($isbnValidator->validate($isbn)) {
    die('Die ISBN ist valid!' . PHP_EOL);
}

throw new Exception('Die ISBN ist nicht valid!'. PHP_EOL);


class ISBNValidator
{
    /**
     * @param string $isbn
     * @return bool
     */
    public function validate($isbn)
    {
        $normalizedIsbn = $this->normalize($isbn);
        $splittedIsbn = $this->split($normalizedIsbn);

        if (count($splittedIsbn) != 5) {
            return false;
        }

        return $this->ensureIdentifierIsValid($isbn[0])
            && $this->ensureGroupIdentifierIsValid($isbn[1])
            && $this->ensureChecksumIsValid($normalizedIsbn);
    }

    public function split($isbn)
    {
        return explode('-', $isbn);
    }


    /**
     * @param string $isbn
     * @return array
     */
    private function normalize($isbn) 
    {
    	$isbn = str_replace('ISBN', '', $isbn);
        $isbn = str_replace(' ', '-', trim($isbn));
        
        return $isbn;
    }

    /**
     * @param $identifier
     * @return bool
     */
    private function ensureIdentifierIsValid($identifier)
    {
    	return filter_var($identifier, FILTER_VALIDATE_INT) !== false;
    }

    /**
     * @param $groupIdentifier
     * @return bool
     */
    private function ensureGroupIdentifierIsValid($groupIdentifier)
    {
    	if (!filter_var($groupIdentifier, FILTER_VALIDATE_INT)
            || strlen($groupIdentifier) >= 5
            || strlen($groupIdentifier) === 0
        ) {
    		return false;
    	}

        $length = strlen($groupIdentifier);

        switch ($groupIdentifier) {
            case $length === 1:
                return ($groupIdentifier >= 0 && $groupIdentifier <= 5) || ($groupIdentifier = 7);
            case $length === 2:
                return ($groupIdentifier >= 80 && $groupIdentifier <= 94);
            case $length === 3:
                return ($groupIdentifier >= 600 && $groupIdentifier <= 649) || !($groupIdentifier >= 950 && $groupIdentifier <= 989);
            case $length === 4:
                return ($groupIdentifier >= 9900 && $groupIdentifier <= 9989);
            case $length === 5:
                return ($groupIdentifier >= 99900 && $groupIdentifier <= 99999);
            default:
                return false;
        };
    }

    /**
     * @param string $isbn
     * @return bool
     */
    private function ensureChecksumIsValid($isbn)
    {
        $numbers = str_split(str_replace('-', '', $isbn));

        $result = 0;
        $counter = 1;

        $numberOfItems = count($numbers);

        foreach ($numbers as $number) {
            if ($counter == $numberOfItems) {
                break;
            }

            if ($counter % 2 == 0) {
                $number = $number * 3;
            }
            $counter++;
            $result += $number;
        }

        $isbnChecksum = end($numbers);
        $calculatedChecksum = 10 -  substr($result, -1, 1);


        if ($calculatedChecksum == 10) {
            $calculatedChecksum = 0;
        }

        return $calculatedChecksum == $isbnChecksum;
   }
}
