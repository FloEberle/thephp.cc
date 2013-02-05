<?php

$dom = new DOMDocument();
$dom->load('productNS.xml');

$xp = new DOMXPath($dom);
$xp->registerNamespace('p','competec:product');

$res = $xp->query('/p:product/p:description');
var_dump($res->length);
