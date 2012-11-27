<?php
include __DIR__.'/autoload.php';

$game = new Game();

$game->setUp();

$game->run();

var_dump($game->getGameStatus());
