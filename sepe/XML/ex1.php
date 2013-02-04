<?php

$doc = new DOMDocument();

$doc->load('ex1.xml');

$xpath = new DOMXPath($doc);
$xpath->registerNamespace('competec', 'http://competec.ch/product');
$xpath->registerNamespace('images', 'http://competec.ch/images');

$queryDesc = '/competec:product/competec:description/competec:long';
$entrieDesc = $xpath->query($queryDesc);

$queryURL = '/competec:product/images:images/images:image/images:size[@variant="original"]';
$entrieURL = $xpath->query($queryURL);

//var_dump($entrieURL->length);

echo 'DescLong: ' . $entrieDesc->item(0)->nodeValue . PHP_EOL;
echo 'BildURL: ' . $entrieURL->item(0)->getAttribute('src') . PHP_EOL; 
