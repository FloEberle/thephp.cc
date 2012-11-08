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
     * @param $isbn
     * @throws InvalidIsbnException
     */
    private function setIsbn($isbn)
    {
        //Validation
        /**
         * @todo Auslagern / Refactoren, z.B. Validator Obj, setter ist ziemlich ueberladen imho.
         */
        $isbn = str_replace('-', '', $isbn);
        $isbn = str_replace(' ', '', $isbn);
        if(strlen($isbn) !== 13){
            throw new InvalidIsbnException('Laenge der ISBN ist nicht 13. ISBN='.$isbn);
            
        }
        if(!ctype_digit($isbn)){
            throw new InvalidIsbnException('Nicht alle Zeichen der ISBN sind Zahlen. ISBN='.$isbn);
        }
        $sum = 0;
        for ($i = 0; $i < 12; $i++){
            if($i%2 == 0){
                $sum += (int) $isbn{$i};
            } else {
                $sum += 3 * (int) $isbn{$i};
            }
        }
        
        $checksum = 10 - ($sum %10);
        if($checksum === 10){
            $checksum = 0;
        }
        $expected = (int) substr($isbn, -1);
                
        if($checksum != $expected){
            throw new InvalidIsbnException('Ungueltige Checksumme der ISBN. checksum='.$checksum.', expected='.$expected.' ISBN='.$isbn);
        }
        //Set
        $this->isbn = (int) $isbn;
    }
    
    // http://php.net/manual/en/language.oop5.object-comparison.php
}
