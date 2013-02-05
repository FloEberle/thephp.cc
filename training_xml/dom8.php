<?php

$product = new DOMDocument();
$product->load('product.xml');

$catalog = new DOMDocument();
$catalog->load('catalog.xml');

$cat = $product->getElementsByTagName('category')->item(0);
$catId = $cat->getAttribute('id');
var_dump($catId);

foreach($catalog->getElementsByTagName('category') as $category) {
    if ($category->getAttribute('id') == $catId) {
        $import = $product->importNode($category);
        $cat->appendChild($import);
        break;
    }
}


$product->formatOutput = true;
echo $product->saveXML();
