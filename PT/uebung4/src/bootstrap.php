<?php

require __DIR__ . '/autoload.php';
$configuration = new Configuration();
$gameColors = $configuration->getColors();
$cube = new Cube($gameColors);
$game = new Game($configuration, $cube);
