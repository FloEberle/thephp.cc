<?php

$dom = new DOMDocument();
$dom->load('competec.xml');

$xp = new DOMXPath($dom);
$xp->registerNamespace('prod', 'http://competec.ch/product');
$xp->registerNamespace('img', 'http://competec.ch/images');

var_dump($xp->query('//prod:description/prod:long')->item(0)->nodeValue);

$prices = $xp->query('//prod:price');
$min = -1;
$max = -1;
foreach($prices as $price) {
    $value = $price->getAttribute('value');
    if ($value < $min || $min == -1) {
        $min = $value;
    }
    if ($value > $max) {
        $max = $value;
    }
}
var_dump($min, $max);

var_dump($xp->query('//img:size[@variant="original"]')->item(0)->getAttribute('src'));