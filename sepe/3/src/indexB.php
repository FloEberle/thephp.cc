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
$user3->confirm('');

// Ablehnen ohne vorherige Anfrage
$user3->decline('');

// addFriendRequest ohne Parameter
$user3->addFriendRequest('');

// Entfernen eines nicht vorhandenen Freundes
$user3->removeFriend('');
