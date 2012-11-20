<?php

class User
{
    private $friendRequests = array();
    private $friends = array();
    private $subscriptions = array();

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    /**
     * @param User $friend
     * @return bool
     * Erweiterung der API um sicherzustellen, dass FriendRequest + confirmFR funktioniert
     */
    public function hasFriend(User $friend)
    {
        return in_array($friend, $this->friends, true);
    }

    /**
     * @param User $friend
     * @return bool
     */
    public function hasSubscription(User $friend)
    {
        return in_array($friend, $this->subscriptions, true);
    }

    /**
     * @param FriendRequest $friendRequest
     * @throws ForeignFriendRequestException SelfReferencingFriendRequestException
     */
    public function addFriendRequest(FriendRequest $friendRequest)
    {
        if ($friendRequest->getTo() !== $this) {
            throw new ForeignFriendRequestException('kann keinen fremden FriendRequest entgegen nehmen');
        }

        $this->friendRequests[] = $friendRequest;
    }

    /**
     * @param FriendRequest $friendRequest
     * @return bool
     */
    private function hasFriendRequest(FriendRequest $friendRequest)
    {
        return in_array($friendRequest, $this->friendRequests, true);
    }

    /**
     * @param FriendRequest $friendRequest
     * @throws MissingFriendRequestException
     */
    public function confirm(FriendRequest $friendRequest)
    {
        if (!$this->hasFriendRequest($friendRequest)) {
            throw new MissingFriendRequestException('kein friendRequest zum bestätigen');
        }
        $this->addFriendShip($friendRequest);
        $this->removeFriendRequest($friendRequest);
    }

    /**
     * @param SubscriptionRequest $subscriptionRequest
     */
    public function addSubscription (SubscriptionRequest $subscriptionRequest)
    {
        $this->subscriptions[] = $subscriptionRequest->getTo();
    }

    /**
     * @param FriendRequest $friendRequest
     */
    private function addFriendShip(FriendRequest $friendRequest)
    {
        $this->friends[] = $friendRequest->getFrom();
        $friendRequest->getFrom()->friends[] = $this;
    }

    /**
     * @param FriendRequest $friendRequest
     * @throws MissingFriendRequestException
     */
    public function decline(FriendRequest $friendRequest)
    {
        if(!$this->hasFriendRequest($friendRequest)) {
            throw new MissingFriendRequestException('kein friendRequest zum ablehnen');
        }
        $this->removeFriendRequest($friendRequest);
        return true;
    }

    /**
     * @param FriendRequest $friendRequest
     */
    private function removeFriendRequest(FriendRequest $friendRequest)
    {
        foreach ($this->friendRequests as $index => $f) {
            if ($friendRequest === $f) {
                unset($this->friendRequests[$index]);
                return;
            }
        }
    }

    /**
     * @param User $friend
     * @throws InvalidArgumentException
     */
    public function removeFriend(User $friend)
    {
        if (!$this->hasFriend($friend)) {
            throw new InvalidFriendRemovalException('User "' . $friend->getName() . '" ist kein Freund');
        }

        foreach ($this->friends as $index => $f) {
            if ($friend === $f) {
                unset($this->friends[$index]);
                if ($friend->hasFriend($this)) {
                    $friend->removeFriend($this);
                }
                return;
            }
        }
    }
}
