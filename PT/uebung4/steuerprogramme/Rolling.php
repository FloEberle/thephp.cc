<?php

require_once '../src/Cube.php';
require_once '../src/Player.php';
require_once '../src/GameColors.php';
require_once '../src/PlayerCards.php';

$gameColors = new GameColors();

$cube = new Cube($gameColors);
// var_dump($cube);

$playerCards = new PlayerCards($gameColors);

$numberOfCards = 5;
$alice = new Player($playerCards, $numberOfCards, 'Alice');



$color = $cube->roll();
if ($alice->hasCardColor($color)){
    $alice->removeCard($color);
}


$color = $cube->roll();
if ($alice->hasCardColor($color)){
    $alice->removeCard($color);
}


$color = $cube->roll();
if ($alice->hasCardColor($color)){
    $alice->removeCard($color);
}


$color = $cube->roll();
if ($alice->hasCardColor($color)){
    $alice->removeCard($color);
}
