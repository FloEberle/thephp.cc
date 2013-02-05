<?php

$dom = new DOMDocument();
$dom->load('functions.xml');
$xp = new DOMXPath($dom);


// $res = $xp->query('//child[position() = last()]');

$res = $xp->query('//container//child[position() = last()]');

var_dump($res->length);

foreach($res as $node) {
var_dump($node->getAttribute('id'));
}

