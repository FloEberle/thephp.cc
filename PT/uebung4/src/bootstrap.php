<?php

require __DIR__ . '/autoload.php';
$configuration = new Configuration();
$gameColors = new GameColors($configuration);
$cube = new Cube($gameColors);
$playerCollection = new PlayerCollection($configuration);
$game = new Game($configuration, $gameColors, $cube, $playerCollection);
