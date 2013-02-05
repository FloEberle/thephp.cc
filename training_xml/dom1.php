<?php

$dom = new DOMDocument();
$dom->load('product.xml');

var_dump($dom);

echo $dom->saveXML();
