<?php

$dom = new DOMDocument();
$dom->preserveWhiteSpace = false;

$dom->load('product.xml');

echo $dom->saveXML();
