<?php

require_once __DIR__ . '/isbn.php';

$isbnNumber = '978-3-86680-192-9';
$isbnNumber = '978 3 86680 192 9';

$isbn = new ISBN($isbnNumber);

print (string) $isbn . PHP_EOL;