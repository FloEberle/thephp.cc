<?php 
	
class ValidationISBN {
	
	/*
		@var string $isbn
	*/
	private $isbn;
	
	
	public function __construct($isbn)
	{
		$this->setIsbn($isbn);
	}
	
	private function setIsbn($isbn)
	{
		$number = explode("-",$isbn);
		if(!isset($number))
		{
			$number = explode(" ", $isbn);
		}
		if(!isset($number)){
			die('Die ISBN Nummer hat kein richtiges Format: '.$isbn);
                        
		}
                if(strlen($isbn) < 17)
                {
                   die('Dies ISBN Nummer besteht aus 17 Zeichen: '.$isbn);
                    
                }
                if(!$this->groupValidation($number['0']))
                {
                    die('Die ISBN Gruppe ist nicht vorhanden: '.$isbn);
               
                }
                if(!$this->checksumValidation($isbn))
                {
                    die('Dies ISBN nummer ist nicht Valid: '.$isbn);
                   
                }else{
                    die('Die ISBN Nummer '.$isbn.' ist korrekt!');
                   
                    }
		
		return true; 		
		
	}
	
	private function groupValidation($number)
	{
		if(($number >= 0 && $number <= 5)
		   || $number == 7 
		   || ($number >= 80 && $number <= 94)
		   || ($number >= 600 && $number <= 649)
		   || ($number >= 950 && $number <=989)
		   || ($number >= 9900 && $number <= 9989)
		   || ($number >= 99900 && $number <= 99999)
		   )
		   {
			return true;
                   }
		   else
                   {
			return false;
		   }
			
                   
        }
        
	private function checksumValidation($isbn)
	{
            
            $check = 0;
            for($i = 0; $i <= 12; $i++)
            {
                if($i % 2 == 0){
                     $check += (int)$isbn{$i}; 
                }else{
                     $check += 3 * (int)$isbn{$i};
                }
                                              
            }
              $sum = 10 - ($check % 10);  
              
            if($sum === 10){
                return false;
            }else{
                return true; 
            }  
            
	}
	
	
}
	
	
?>