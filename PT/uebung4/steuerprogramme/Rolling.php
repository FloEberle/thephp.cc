<?php

require_once '../src/Cube.php';
require_once '../src/Player.php';

$cube = new Cube();

$numberOfCards = 5;
$alice = new Player($cube, $numberOfCards);

var_dump($alice);

