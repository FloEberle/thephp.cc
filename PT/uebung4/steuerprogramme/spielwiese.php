<?php

require_once '../src/Cube.php';
require_once '../src/Player.php';

$cards = array();
$cube = new Cube();

for ($i = 1; $i <= 5; $i++){
    echo $cube->roll();
}



