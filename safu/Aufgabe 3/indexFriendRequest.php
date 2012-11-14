<?php
require 'friendRequest.php';
try{
    $setUser1 = new User("Samuel");
    $setUser2 = new User("Hugo");
    $friendRequest = new FriendRequest($setUser2, $setUser1);
    $setUser1->addFriendRequest($friendRequest);
    $setUser1->confirm($friendRequest);
    var_dump($setUser1);
    var_dump($setUser2);
    var_dump($friendRequest);
    $setUser1->removeFriend('Hugo', $setUser1);
    var_dump($setUser1);
} catch(friendRequestException $e) {
   echo'Error: '.$e->getMessage();
}