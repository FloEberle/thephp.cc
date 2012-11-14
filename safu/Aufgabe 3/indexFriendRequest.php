<?php
require 'friendRequest.php';
try{
    $setUser = new User("Samuel");
    $friendRequest = new FriendRequest('test1', 'Samuel');
    $setUser->addFriendRequest($friendRequest);
    $setUser->confirm($friendRequest);
        
    var_dump($setUser);
    var_dump($friendRequest);
    
    $setUser->removeFriend('', $setUser);
    
    var_dump($setUser);
    var_dump($friendRequest);

} catch(friendRequestException $e) {
   echo'Error: '.$e->getMessage();
}