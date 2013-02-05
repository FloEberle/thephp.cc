<?php

$dom = new DOMDocument();
$dom->load('productNS.xml');

var_dump($dom->documentElement->nodeValue);
