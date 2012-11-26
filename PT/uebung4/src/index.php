<?php

require __DIR__ . '/autoload.php';

$configurationBackend = new ConfigurationBackend();
$gameColors = new GameColors($configurationBackend);
$cube = new Cube();


