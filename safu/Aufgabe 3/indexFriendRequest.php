<?php
require 'friendRequest.php';

$setUser = new User("Samuel");
$friendRequest = new FriendRequest('tset', 'Samuel');
$setUser->decline($friendRequest);
var_dump($setUser);
var_dump($friendRequest);