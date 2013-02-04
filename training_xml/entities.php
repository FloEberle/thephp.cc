<?php

$dom = new DOMDocument();
$dom->substituteEntities = true;
$dom->resolveExternals = true;
$dom->load('entities.xml');

echo $dom->saveXML();
