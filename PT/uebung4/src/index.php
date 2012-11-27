<?php

require __DIR__ . '/autoload.php';

$configuration = new Configuration();
$gameColors = new GameColors($configuration);
$cube = new Cube($gameColors);
$playerCollection = new PlayerCollection($configuration);
$cards = new PlayerCards($gameColors);

foreach ($playerCollection->getPlayerNames() as $name){
    $playerCollection->add(new Player($cards, $name));
}
$players = $playerCollection->getPlayers();

$gameStatus = 'running';
while ($gameStatus == 'running'){
    foreach($players as $player){
        echo $player->getName() . ' würfelt' . PHP_EOL;

        $color = $cube->roll();
        echo 'es wurde ' . $color . ' gewürfelt' . PHP_EOL;

        if ($player->hasCardColor($color)){
            $player->removeCard($color);
            echo $player->getName() . ' legt ' . $color . ' weg' . PHP_EOL;
        }
        if ($player->hasCards() == false){
            echo $player->getName() . ' hat gewonnen' . PHP_EOL;
            $gameStatus = 'over';
            return;
        }
    }
}
