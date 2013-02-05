<?php

$src = new DOMDocument();
$src->load('product.xml');

$tpl = new DOMDocument();
$tpl->load('template15.xsl');

$proc = new XSLTProcessor();
$proc->importStylesheet($tpl);
$proc->setParameter('', 'config', 'set by php');
$proc->registerPHPFunctions();

$result = $proc->transformToDoc($src);

echo $result->saveXML();