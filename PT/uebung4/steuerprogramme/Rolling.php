<?php

require_once '../src/Cube.php';
require_once '../src/Player.php';

$cube = new Cube();

$alice = new Player($cube);
var_dump($alice);
