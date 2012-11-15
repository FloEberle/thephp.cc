<?php
require __DIR__ . '/friendRequest.php';
require __DIR__ . '/user.php';
require __DIR__ . '/FriendRequestException.php';


try{
    $setUser1 = new User("Samuel");
    $setUser2 = new User("Hugo");
    $friendRequest = new FriendRequest($setUser2, $setUser1);
    $setUser1->addFriendRequest($friendRequest);
    $setUser1->confirm($friendRequest);
    $setUser2->addFriendRequest($friendRequest);
    $setUser2->confirm($friendRequest);
    var_dump($setUser1);
    var_dump($setUser2);
    var_dump($friendRequest);
    
    $setUser1 = new User("Samuel");
    $setUser2 = new User("Hugo");
    $friendRequest = new FriendRequest($setUser2, $setUser1);
    $setUser1->addFriendRequest($friendRequest);
    $setUser1->decline($friendRequest);
    var_dump($setUser1);
    var_dump($setUser2);
    var_dump($friendRequest);
 
 
    
    
} catch(friendRequestException $e) {
   echo'Error: '.$e->getMessage();
}