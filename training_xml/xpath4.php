<?php

$dom = new DOMDocument();
$dom->load('productNS.xml');

$xp = new DOMXPath($dom);
$xp->registerNamespace('p','competec:product');
$xp->registerNamespace('product','competec:product');

$res = $xp->query('//p:categories//p:category', $dom->documentElement);
var_dump($res->length);
