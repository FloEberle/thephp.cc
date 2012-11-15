<?php

require 'Requests.php';

class User
{
    private $friendRequests = array();
    private $friends = array();
    private $subscriptions = array();

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
     * @param User $friend
     * @return bool
     */
    public function hasSubscription(User $friend)
    {
        return (array_key_exists($friend->id, $this->subscriptions));
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
        $this->addFriendShip($friendRequest);
        $this->removeFriendRequest($friendRequest);
    }

    /**
     * @param SubscriptionRequest $subscriptionRequest
     */
    public function addSubscription (SubscriptionRequest $subscriptionRequest)
    {
        $subscriptionRequest->getFrom()->subscriptions[$this->id] = $subscriptionRequest->getTo();
    }

    /**
     * @param FriendRequest $friendRequest
     */
    private function addFriendShip (FriendRequest $friendRequest)
    {
        $this->friends[$friendRequest->getFrom()->id] = $friendRequest->getFrom();
        $friendRequest->getFrom()->friends[$this->id] = $friendRequest->getTo();
    }
    /**
     * @param FriendRequest $friendRequest
     */
    public function decline(FriendRequest $friendRequest)
    {
        if(!in_array($friendRequest->getFrom(), $this->friendRequests)) {
            throw new InvalidArgumentException('kein friendRequest zum ablehnen');
        }
        $this->removeFriendRequest($friendRequest);
    }

    /**
     * @param FriendRequest $friendRequest
     */
    private function removeFriendRequest(FriendRequest $friendRequest)
    {
        unset ($this->friendRequests[$friendRequest->getFrom()->id]);
    }

    /**
     * @param User $friend
     * @throws InvalidArgumentException
     */
    public function removeFriend(User $friend)
    {
        if(!$this->hasFriend($friend)) {
            throw new InvalidArgumentException('übergebener User nicht in friends');
        }
        unset ($this->friends[$friend->id]);
        unset ($friend->friends[$this->id]);
    }
}
