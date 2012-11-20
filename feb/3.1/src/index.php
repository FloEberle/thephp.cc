<?php
require_once 'User.php';
require_once 'FriendRequest.php';

$alice = new User();
$alice->_setUsername('Alice');

$bob = new User();
$bob->_setUsername('Bob');

$bobRequestsAlice = new FriendRequest($bob, $alice);
$alice->addFriendRequest($bobRequestsAlice);
print_r($alice);
$alice->confirm($bobRequestsAlice);

print_r($alice);

print_r($bob);

$alice->removeFriend($bob);

echo '======================';


print_r($alice);

print_r($bob);