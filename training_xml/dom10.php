<?php

$product = new DOMDocument();
$product->load('productNS.xml');

$catalog = new DOMDocument();
$catalog->load('catalogNS.xml');

$cat = $product->getElementsByTagName('category')->item(0);
$catId = $cat->getAttribute('id');
var_dump($catId);

foreach($catalog->getElementsByTagName('category') as $category) {
    if ($category->getAttribute('id') == $catId) {
        $import = $product->importNode($category);
        $cat->parentNode->replaceChild($import, $cat);
        break;
    }
}

$product->formatOutput = true;
echo $product->saveXML();
