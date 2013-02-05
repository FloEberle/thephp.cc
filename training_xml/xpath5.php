<?php

$dom = new DOMDocument();
$dom->load('productNS.xml');

$xp = new DOMXPath($dom);
$xp->registerNamespace('p','competec:product');

$res = $xp->evaluate('string(/p:product/p:description[1]/@type)');
var_dump($res);


