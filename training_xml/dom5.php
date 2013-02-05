<?php

$dom = new DOMDocument();
$dom->loadXML('<?xml version="1.0" ?><product />');
$product = $dom->documentElement;

$product->setAttribute('sku', '123456');
$description = $dom->createElement('description');
$product->appendChild($description);
$description->setAttribute('type','short');

echo $dom->saveXML();
