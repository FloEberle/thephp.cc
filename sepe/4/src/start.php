<?php

require 'autoload.php';

$colors = [
    'red',
    'blue',
    'yellow',
    'green',
    'black',
    'white'
];

$players = [
    'Alice',
    'Bob',
    'Carol',
];

$dice = new Dice($colors);
$cardGenerator = new CardGenerator($colors);
$playerCollection = new PlayerCollection();

foreach ($players as $name) {
    $playerCollection->addPlayer(
        new Player($name, $dice, $cardGenerator)
    );
}

$game = new GameController($playerCollection);
$game->start();