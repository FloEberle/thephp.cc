<?php

require_once '../src/Cube.php';

$cube = new Cube();
$color = $cube->roll();
var_dump($color);
