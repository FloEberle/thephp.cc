<?php

$isbn = new ISBN('...');
$otherIsbn = new ISBN('...');

var_dump($isbn->isEqualTo($otherIsbn));

class ISBN
{
    public function isEqualTo(ISBN $isbn)
    {
        return (string) $this == (string) $isbn;
    }
}
