<?php

require __DIR__ . '/autoload.php';
$configuration = new Configuration();
$gameColors = $configuration->getColors();
$dice = new Cube($gameColors);
$game = new Game($configuration, $dice);
