<?php
final class Isbn
{
    /**
     * @var int
     */
    private $isbn;
    
    /**
     * @var string
     */
    private $errorDescription;


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
        /**
         * @todo Auslagern / Refactoren, z.B. Validator Obj, setter ist immernoch ziemlich ueberladen imho.
         */
        $groups = explode('-', $isbn, -1);
        if(empty($groups)){
            $groups = explode(' ', $isbn);
        }

        if(!isset($groups[1]) || !ctype_digit($groups[1])){
            throw new ValidateException('Ungueltiges ISBN Format. ISBN='.$isbn);
        }

        if(!$this->isValidGroupNr((int) $groups[1])){
            throw new ValidateException('Ungueltige ISBN Gruppennummer ISBN='.$isbn);
        }

        $isbn = str_replace('-', '', $isbn);
        $isbn = str_replace(' ', '', $isbn);
        if(strlen($isbn) !== 13){
            throw new ValidateException('Laenge der ISBN ist nicht 13. ISBN='.$isbn);
            
        }
        if(!ctype_digit($isbn)){
            throw new ValidateException('Nicht alle Zeichen der ISBN sind Zahlen. ISBN='.$isbn);
        }

        if (! $this->isValidChecksum($isbn))
        {
            throw new ValidateException('Ungueltige Checksumme der ISBN. ISBN=' . $isbn);
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
                $sum += (int)$isbn{$i};
            } else {
                $sum += 3 * (int)$isbn{$i};
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
        $length = strlen((string) $group);

        switch($length){
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