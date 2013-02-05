<?php

$src = new DOMDocument();
$src->load('product.xml');

$tpl = new DOMDocument();
$tpl->load('template13.xsl');

$proc = new XSLTProcessor();
$proc->importStylesheet($tpl);

$result = $proc->transformToDoc($src);

echo $result->saveXML();