<?php

require __DIR__ . '/exercise3a.php';

$user1 = new User();
$user2 = new User();

$request1 = new FriendRequest($user1,$user2);
$user1->addFriendRequest($request1);
$user1->confirm($request1);
$user1->decline($request1);

var_dump($user1);