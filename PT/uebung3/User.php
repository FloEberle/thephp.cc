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
        if($friendRequest->getFrom()->id === $this->id) {
            throw new InvalidArgumentException('Freundschaft mit sich selbst ist nicht erlaubt');
        }

        $this->friendRequests[$friendRequest->getFrom()->id] = $friendRequest->getFrom();
    }


    /**
     * @param FriendRequest $friendRequest
     * @return bool
     */
    private function hasFriendRequest(FriendRequest $friendRequest)
    {
        return in_array($friendRequest->getFrom(), $this->friendRequests);

    }


    /**
     * @param FriendRequest $friendRequest
     * @throws InvalidArgumentException
     */
    public function confirm(FriendRequest $friendRequest)
    {
        if(!$this->hasFriendRequest($friendRequest)) {
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
        $this->subscriptions[$subscriptionRequest->getTo()->id] = $subscriptionRequest->getTo();
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
        if(!$this->hasFriendRequest($friendRequest)) {
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
