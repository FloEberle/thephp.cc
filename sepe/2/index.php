<?php

require __DIR__ . '/../src/autoload.php';

// gültige ISBN 978-3-446-23880-0

$value1 = '978-3-446-23880-0';
$value2 = '978-3-446-23880-0';
$value3 = '978-3-446-23880-0';

$isbn = new ISBN('978-3-446-23880-0');
$isbn->isEqualTo('978-3-446-23880-0');

var_dump($isbn);