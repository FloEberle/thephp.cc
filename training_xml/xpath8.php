<?php

$dom = new DOMDocument();
$dom->load('functions.xml');
$xp = new DOMXPath($dom);

// $res = $xp->query('//container[@id="c1"]/child');
// $res = $xp->query('//child[parent::container[@id="c1"]]');
// $res = $xp->query('preceding-sibling::container', $xp->query('//container[@id="c3"]')->item(0));

$res = $xp->query('//container[@id="c1"]|//container[@id="c3"]');


var_dump($res->length);

foreach($res as $node) {
var_dump($node->getAttribute('id'));
}

