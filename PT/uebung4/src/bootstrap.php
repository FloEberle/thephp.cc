<?php

require __DIR__ . '/autoload.php';
$configuration = new Configuration();
$gameColors = $configuration->getColors();
$dice = new Dice($gameColors);
$game = new Game($configuration, $dice);
