<?php

$dom = new DOMDocument();
$dom->load('competec.xml');

$xp = new DOMXPath($dom);
$xp->registerNamespace('prod', 'http://competec.ch/product');
$xp->registerNamespace('img', 'http://competec.ch/images');

var_dump($xp->query('//prod:description/prod:long')->item(0)->nodeValue);

$prices = $xp->query('//prod:price');
$values = array();
foreach($prices as $price) {
    $values[] = $price->getAttribute('value');
}
sort($values);
var_dump($values[0], $values[count($values)-1]);

var_dump($xp->query('//img:size[@variant="original"]')->item(0)->getAttribute('src'));
