<?php

require 'FriendRequest.php';

$john = new User('1', 'john');
$kasperle = new User('2', 'kasperle');

$johnRequestsKasperle = new FriendRequest($john, $kasperle);
echo ('addFriendRequest' . PHP_EOL . '###############################' . PHP_EOL);
$kasperle->addFriendRequest($johnRequestsKasperle);
var_dump($john);
var_dump($kasperle);
echo ('###############################'.PHP_EOL);

echo ('confirmFriendRequest' . PHP_EOL . '###############################' . PHP_EOL);
$kasperle->confirm($johnRequestsKasperle);
var_dump($john);
var_dump($kasperle);
echo ('###############################'.PHP_EOL);


echo ('removeFriend' . PHP_EOL . '###############################' . PHP_EOL);
$kasperle->removeFriend($john);
var_dump($john);
var_dump($kasperle);
echo ('###############################'.PHP_EOL);



class User
{
    private $friendRequests = array();
    private $friends = array();

    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function addFriendRequest(FriendRequest $friendRequest)
    {
        $this->friendRequests[$friendRequest->getFrom()->id] = $friendRequest->getFrom();
    }

    public function confirm(FriendRequest $friendRequest)
    {
        if(!in_array($friendRequest->getFrom(), $this->friendRequests)) {
            throw new InvalidArgumentException('kein friendRequest vorhanden');
        }
        $this->friends[$friendRequest->getFrom()->id] = $friendRequest->getFrom();
        $friendRequest->getFrom()->friends[$this->id] = $friendRequest->getTo();
        unset ($this->friendRequests[$friendRequest->getFrom()->id]);
    }

    public function decline(FriendRequest $friendRequest)
    {
        unset ($this->friendRequests[$friendRequest->getFrom()]);
    }

    public function removeFriend(User $friend)
    {
        if(!in_array($friend, $this->friends)) {
            throw new InvalidArgumentException('übergebener User nicht in friends');
        }
        unset ($this->friends[$friend->id]);
        unset ($friend->friends[$this->id]);
    }
}

