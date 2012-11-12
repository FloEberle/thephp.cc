<?php

class FormValidator
{
    public function validate(array $formData)
    {
        // ...
    
        if (isset($formData['isbn'])) {
            
            try {
                $isbn = new ISBN($formData['isbn']);
            }
            
            catch (IsbnValidationException $e) {
                return false;
            }
        }
        
        // ...
        
        $this->storeData($foo, $bar, $baz, $isbn, ...);
        
        // ...
    }
}

... public function storeData($foo, $bar, $baz, ISBN $isbn, ...) ...
