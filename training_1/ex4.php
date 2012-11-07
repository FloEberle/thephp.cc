<?php

$a = 42;
var_dump(foo($a)); // 43
var_dump($a); // 42

function foo(&$a)
{
    $a += 1;
    return $a + 1; // 43
}
