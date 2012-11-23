<?php

require_once '../src/Cube.php';
require_once '../src/Player.php';
require_once '../src/GameColors.php';
require_once '../src/ColorBackend.php';
require_once '../src/PlayerCards.php';

// 50 mal jeder würfeln

for($i = 0; $i <= 50; $i++){

    $color = $cube->roll();
    echo 'Alice hat ' . $color . ' gewürfelt' . PHP_EOL;
    if ($alice->hasCardColor($color)){
        $alice->removeCard($color);
    }
    if ($alice->hasCards() == false){
        echo $alice->getName() . ' hat gewonnen' . PHP_EOL;
        die;
    }

    $color = $cube->roll();
    echo 'Bob hat ' . $color . ' gewürfelt' . PHP_EOL;
    if ($bob->hasCardColor($color)){
        $bob->removeCard($color);
    }
    if ($bob->hasCards() == false){
        echo $bob->getName() . ' hat gewonnen' . PHP_EOL;
        die;
    }

    $color = $cube->roll();
    echo 'Carol hat ' . $color . ' gewürfelt' . PHP_EOL;
    if ($carol->hasCardColor($color)){
        $carol->removeCard($color);
    }
    if ($carol->hasCards() == false){
        echo $carol->getName() . ' hat gewonnen' . PHP_EOL;
        die;
    }
    echo '------------' . PHP_EOL;
}
