<?php

$dom = new DOMDocument();
$dom->preserveWhiteSpace = false;

$dom->load('product.xml');

$root = $dom->documentElement;

echo $dom->saveXML();
