<?php
require __DIR__ . 'validationException.php';

class ISBN
{
	/**
	 *	@var string $isbn
	 */
	private $isbn;

	public function __construct($isbn)
	{
		$this->setIsbn($isbn);
	}

	private function setIsbn($isbn)
	{
        if (strlen($isbn) != 17) {
            throw new IsbnValidationException('Ungültige ISBN "' . $isbn . '"');
        }

        if (strstr($isbn, '-') !== false) {
            $parts = explode('-', $isbn);
        } else {
            $parts = explode(' ', $isbn);
        }

        if (count($parts) != 5) {
            throw new IsbnValidationException('Ungültige ISBN "' . $isbn . '"');
        }

        if (!$this->groupValidation($parts[1])) {
            throw new GroupValidationException('Ungültige ISBN "' . $isbn . '"');
        }

        if (!$this->checksumValidation(implode('', $parts))) {
            throw new ChecksumValidationException('Ungültige ISBN "' . $isbn . '"');
        }

        $this->isbn = $isbn;
	}

        public function __toString()
        {
            return str_replace(' ', '-', $this->isbn);
        }

        private function groupValidation($number)
        {
                return ($number >= 0 && $number <= 5) ||
                        $number == 7 ||
                       ($number >= 80 && $number <= 94) ||
                       ($number >= 600 && $number <= 649) ||
                       ($number >= 950 && $number <=989) ||
                       ($number >= 9900 && $number <= 9989) ||
                       ($number >= 99900 && $number <= 99999);
        }

	private function checksumValidation($isbn)
	{
        $checksum = 0;

        for ($i = 0; $i <= 12; $i++)
        {
            if ($i % 2 == 0){
                 $checksum += (int) $isbn[$i];
            } else {
                 $checksum += 3 * (int) $isbn[$i];
            }
        }

        return $checksum % 10 == 0;
	}
}