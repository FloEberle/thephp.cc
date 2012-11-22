<?php

require __DIR__ . '/bootstrap.php';

$configuration = new Configuration(__DIR__ . '/../config/settings.ini');
$factory = new Factory($configuration);
$game = $factory->getInstanceFor('Game');
$game->initialize($factory);
$game->play();