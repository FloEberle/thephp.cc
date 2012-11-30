<?php

require __DIR__ . '/autoload.php';

$colors = [
    'red',
    'blue',
    'yellow',
    'green',
    'black',
    'white',
];

$players = [
    'Alice',
    'Bob',
    'Carol',
];

$dice = new Dice($colors);
$cardSet = new CardSet($colors);
$playerCollection = new PlayerCollection();

foreach ($players as $name) {
    $playerCollection->addPlayer(
        new Player($name, $dice, $cardSet)
    );
}

$game = new Game($playerCollection);
$game->shareCards();
$game->start();