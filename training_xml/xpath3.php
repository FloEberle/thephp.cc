<?php

$dom = new DOMDocument();
$dom->load('productNS.xml');

$xp = new DOMXPath($dom);
$xp->registerNamespace('p','competec:product');
$xp->registerNamespace('product','competec:product');

$res = $xp->query('/product:product[@sku="12345" and @name="Projektor"]/p:description[@type="short"]');
var_dump($res->length);
