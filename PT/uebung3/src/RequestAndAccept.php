<?php

require 'User.php';

$john = new User('1', 'john');
$kasperle = new User('2', 'kasperle');

$johnRequestsKasperle = new FriendRequest($john, $kasperle);
echo ('addFriendRequest' . PHP_EOL . '###############################' . PHP_EOL);
$kasperle->addFriendRequest($johnRequestsKasperle);
var_dump($john);
var_dump($kasperle);
echo ('###############################'.PHP_EOL);

echo ('confirmFriendRequest' . PHP_EOL . '###############################' . PHP_EOL);
$kasperle->confirm($johnRequestsKasperle);
var_dump($john);
var_dump($kasperle);
echo ('###############################'.PHP_EOL);
