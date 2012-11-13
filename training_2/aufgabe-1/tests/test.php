<?php

require __DIR__ . '/../src/autoload.php';

$user = new User(1, 'user@example.com', 'Stefan');
var_dump($user);