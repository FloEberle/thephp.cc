<?php

require __DIR__ . '/User.php';
require __DIR__ . '/FriendRequest.php';

$user1 = new User('John');
$user2 = new User('Jane');

$request1 = new FriendRequest($user1, $user2);
$user2->addFriendRequest($request1);

$user2->confirm($request1);

echo 'user1 nach confirm' . PHP_EOL;
var_dump($user1);
echo 'user2 nach confirm:' . PHP_EOL;
var_dump($user2);

/*
$request2 = new FriendRequest($user2, $user1);
$user1->addFriendRequest($request2);

$user1->decline($request2);

echo 'user1 nach decline' . PHP_EOL;
var_dump($user1);
echo 'user2 nach decline:' . PHP_EOL;
var_dump($user2);
*/