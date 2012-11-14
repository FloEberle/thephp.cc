<?php

require __DIR__ . '/User.php';
require __DIR__ . '/FriendRequest.php';

$user1 = new User();
$user1->setUserName('John');
$user2 = new User();
$user2->setUserName('Jane');

$request1 = new FriendRequest($user1, $user2);
$user2->addFriendRequest($request1);

// Bestätigung ohne vorherige Anfrage

// Ablehnen ohne vorherige Anfrage

// Entfernen eines nicht vorhandenen Freundes

