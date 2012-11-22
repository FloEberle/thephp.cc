<?php

require_once '../src/GameColors.php';

$colors = parse_ini_file(__DIR__ . '/../src/colors.ini');
$gameColors = new GameColors();
var_dump($gameColors);
