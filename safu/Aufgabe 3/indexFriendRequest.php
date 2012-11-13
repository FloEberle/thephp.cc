<?php
require 'friendRequest.php';

$setUser = new User("Samuel");
$friendRequest = new FriendRequest('tset', 'Samuel');
$setUser->confirm($friendRequest);
var_dump($setUser);
var_dump($friendRequest);