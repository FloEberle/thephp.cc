<?php

libxml_use_internal_errors(true);

$dom = new DOMDocument();
$dom->load('productNS.xml');

$rc= $dom->schemaValidate('productNS.xsd');

var_dump($rc);
var_dump(libxml_get_errors());