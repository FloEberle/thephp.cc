<?php

require 'FriendRequest.php';

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
     * @param User $friend
     * @return bool
     * Erweiterung der API um sicherzustellen, dass FriendRequest + confirmFR funktioniert
     */
    public function hasFriend(User $friend)
    {
        return (array_key_exists($friend->id, $this->friends));
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
        if(!in_array($friendRequest->getFrom(), $this->friendRequests)) {
            throw new InvalidArgumentException('kein friendRequest zum ablehnen');
        }
        unset ($this->friendRequests[$friendRequest->getFrom()->id]);
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
