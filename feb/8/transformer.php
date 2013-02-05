<?php

$xslDoc = new DOMDocument();
$xslDoc->load("transformation.xsl");

$xmlDoc = new DOMDocument();
$xmlDoc->load("product.xml");

$proc = new XSLTProcessor();
$proc->importStylesheet($xslDoc);
echo $proc->transformToXML($xmlDoc);

?>