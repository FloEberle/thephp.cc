<?php

$dom = new DOMDocument;
$dom->load('xpath1.xml');

$xpath = new DOMXPath($dom);
$xpath->registerNameSpace('p', 'http://competec.ch/product');

// 1
$long_desc = $xpath->query('//p:description/p:long');
var_dump($long_desc->item(0)->nodeValue);



// 2
$prices = $xpath->query('//p:prices');




// 3
$xpath->registerNameSpace('img', 'http://competec.ch/images');
$imageurl = $xpath->query('//img:size[@variant="original"]');
var_dump($imageurl->item(0)->getAttribute('src'));

