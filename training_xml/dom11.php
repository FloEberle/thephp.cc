<?php

$dom = new DOMDocument();
$dom->loadXML('<?xml version="1.0" ?><product xmlns="competec:product" />');

for($t=0; $t<10; $t++) {
    $node = $dom->createElementNS('demo:'.$t, 'foo');
    $node->setAttribute('id', 'some' . $t);
    $dom->documentElement->appendChild($node);
}

var_dump($dom->getElementsByTagNameNS('competec:product', 'foo')->length);

$dom->formatOutput = true;
$xml = $dom->saveXML();

echo $xml;


$dom2 = new DOMDocument();
$dom2->loadXML($xml);

var_dump($dom2->getElementsByTagNameNS('competec:product', 'foo')->length);
var_dump($dom2->getElementsByTagName('foo')->length);
