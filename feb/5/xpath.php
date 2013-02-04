<?php

$dom = new DOMDocument();
$dom->load('product.xml');

$xpath = new DOMXPath($dom);
$xpath->registerNamespace('p', 'http://competec.ch/product');
$xpath->registerNamespace('img', 'http://competec.ch/images');

$longtext = $xpath->query('/p:product/p:description/p:long')->item(0)->nodeValue;
var_dump($longtext);


//------------------
$allPricesNL = $xpath->query('/p:product/p:prices/p:price/@value');

$prices = [];
foreach($allPricesNL as $priceNode) {
    $prices[] = (int) $priceNode->nodeValue;
}
sort($prices);

$min = $prices[0];
var_dump($min);
$max = $prices[count($prices)-1];
var_dump($max);

//-------------------

$originalImgUrl = $xpath->query('/p:product/img:images/img:image/img:size[@variant="original"]/@src')->item(0)->nodeValue;
var_dump($originalImgUrl);


//---------------------- Aufgabe 2 nur mit Xpath

$magicMin = $xpath->query('/p:product/p:prices/p:price[not(preceding-sibling::p:price/@value <= @value) and not(following-sibling::p:price/@value < @value)]/@value');
$magicMax = $xpath->query('/p:product/p:prices/p:price[not(preceding-sibling::p:price/@value >= @value) and not(following-sibling::p:price/@value > @value)]/@value');
var_dump($magicMin->item(0)->nodeValue);
var_dump($magicMax->item(0)->nodeValue);
