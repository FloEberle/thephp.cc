<?php

final class Isbn
{
    /**
     * @var int
     */
    private $isbn;

    /**
     * @param string $isbn
     */
    public function __construct($isbn)
    {
        $this->setIsbn($isbn);
    }

    /**
     * @param string $isbn
     * @throws ValidateException
     */
    private function setIsbn($isbn)
    {
        $groups = explode('-', $isbn);
        if (count($groups) == 1){
            $groups = explode(' ', $isbn);
        }

        if (!isset($groups[1]) || !ctype_digit($groups[1])) {
            throw new ValidateException('Ungueltiges ISBN Format. ISBN='.$isbn, ValidateException::INVALID_FORMAT);
        }

        if (!$this->isValidGroupNr(($groups[1]))) {
            throw new ValidateException('Ungueltige ISBN Gruppennummer ISBN='.$isbn, ValidateException::INVALID_GROUPNR);
        }

        $isbn = str_replace('-', '', $isbn);
        $isbn = str_replace(' ', '', $isbn);
        if (strlen($isbn) !== 13){
            throw new ValidateException('Laenge der ISBN ist nicht 13. ISBN='.$isbn, ValidateException::INVALID_LENGTH);
        }

        if (! $this->isValidChecksum($isbn)) {
            throw new ValidateException('Ungueltige Checksumme der ISBN. ISBN=' . $isbn, ValidateException::INVALID_CHECKSUM);
        }

        $this->isbn = (int) $isbn;
    }

    /**
     * @param string $isbn
     * @return bool
     */
    private function isValidChecksum($isbn)
    {
        $sum = 0;
        for ($i = 0; $i < 12; $i++) {
            if ($i % 2 == 0) {
                $sum += (int)$isbn[$i];
            } else {
                $sum += 3 * (int)$isbn[$i];
            }
        }

        $checksum = 10 - ($sum % 10);
        if ($checksum === 10) {
            $checksum = 0;
        }
        $expected = (int)substr($isbn, -1);

        return $checksum === $expected;
    }


    /**
     * @param int $group
     * @return bool
     */
    private function isValidGroupNr($group)
    {
        switch (strlen($group)) {
            case 1:
                if(($group >= 0 && $group <=5) || $group == 7){
                    return true;
                }
            case 2:
                if($group >=80 && $group <=94){
                    return true;
                }
            case 3:
                if(($group >= 600 && $group <=649) || ($group >=950 && $group <= 989)){
                    return true;
                }
            case 4:
                if($group >= 9900 && $group <= 9989){
                    return true;
                }
            case 5:
                if($group >= 99900 && $group <= 99999){
                    return true;
                }
        }

        return false;
    }
}
