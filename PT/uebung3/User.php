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

/*
echo ('declineFriendRequest' . PHP_EOL . '###############################' . PHP_EOL);
$kasperle->decline($johnRequestsKasperle);
var_dump($john);
var_dump($kasperle);
*/


class User
{
    private $friendRequests = array();
    private $friends = array();

    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * @param FriendRequest $friendRequest
     */
    public function addFriendRequest(FriendRequest $friendRequest)
    {
        $this->friendRequests[$friendRequest->getFrom()->id] = $friendRequest->getFrom();
    }

    /**
     * @param FriendRequest $friendRequest
     * @throws InvalidArgumentException
     */
    public function confirm(FriendRequest $friendRequest)
    {
        if(!in_array($friendRequest->getFrom(), $this->friendRequests)) {
            throw new InvalidArgumentException('kein friendRequest zum bestätigen');
        }
        $this->friends[$friendRequest->getFrom()->id] = $friendRequest->getFrom();
        $friendRequest->getFrom()->friends[$this->id] = $friendRequest->getTo();
        unset ($this->friendRequests[$friendRequest->getFrom()->id]);
    }

    /**
     * @param FriendRequest $friendRequest
     */
    public function decline(FriendRequest $friendRequest)
    {
        if(!in_array($friendRequest->getFrom()->id, $this->friendRequests)) {
            throw new InvalidArgumentException('kein friendRequest zum bestätigen');
        }
        unset ($this->friendRequests->getFrom()->id);
    }

    /**
     * @param User $friend
     * @throws InvalidArgumentException
     */
    public function removeFriend(User $friend)
    {
        if(!in_array($friend, $this->friends)) {
            throw new InvalidArgumentException('übergebener User nicht in friends');
        }
        unset ($this->friends[$friend->id]);
        unset ($friend->friends[$this->id]);
    }
}
