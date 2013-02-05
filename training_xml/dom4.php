<?php

$dom = new DOMDocument();
$dom->load('product.xml');

$all = $dom->getElementsByTagName('*');
foreach($all as $pos => $node) {
    $node->setAttribute('visited', $pos);
}

echo $dom->saveXML();
