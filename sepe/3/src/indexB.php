<?php

require __DIR__ . '/User.php';
require __DIR__ . '/FriendRequest.php';

$user1 = new User();
$user1->setUserName('John');
$user2 = new User();
$user2->setUserName('Jane');
$user3 = new User();
$user3->setUserName('Karl');

$request1 = new FriendRequest($user1, $user2);
$user2->addFriendRequest($request1);

// Bestätigung ohne vorherige Anfrage
$user3->confirm($request1);

// Ablehnen ohne vorherige Anfrage
$user3->decline($request1);

// addFriendRequest an einen User bestehenden Freund
$request2 = new FriendRequest($user3, $user2);
$user3->addFriendRequest($request2);
$user2->confirm($request2);
$user3->addFriendRequest($request2);

// Entfernen eines nicht vorhandenen Freundes
$user3->removeFriend($user1);
