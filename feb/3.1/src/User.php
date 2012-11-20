<?php

/**
 * Frage meinerseits: Wie loest man die zyklische Rekursion des confirm() und removeFriend() ohne
 * auf die private Attribute der fremden Userinstanz zuzugreifen (imho haesslich!) sondern ueber
 * die entsprechenden Methoden..?
 */
class User
{
    /**
     * @var SplObjectStorage
     */
    private $friends;
    /**
     * @var array
     */
    private $friendRequests;

    /**
     * @param FriendRequest $friendRequest
     *
     * @throws FriendRequestException
     */

    public function __construct()
    {
        $this->friends = new SplObjectStorage();
        $this->friendRequests = new SplObjectStorage();
    }

    public function addFriendRequest(FriendRequest $friendRequest)
    {
        if ($friendRequest->getFrom() === $this) {
            throw new FriendRequestException('You can not add yourself as a Friend! Forever alone?', FriendRequestException::ADD_YOURSELF_AS_FRIEND);
        }

        if($this->isFriendOf($friendRequest->getFrom())) {
            throw new FriendRequestException('You already have this Friend!', FriendRequestException::FRIEND_ALREADY_EXISTS);
        }
        $this->friendRequests->attach($friendRequest);
    }

    /**
     * @param FriendRequest $friendRequest
     *
     * @throws FriendRequestException
     */
    public function confirm(FriendRequest $friendRequest)
    {

        if(!$this->hasFriendRequest($friendRequest)) {
            throw new FriendRequestException('Friendrequest not found.', FriendRequestException::FRIENDREQUEST_NOT_FOUND);
        }

        $this->addFriendFromFriendRequest($friendRequest);
        $friendRequest->getFrom()->friends->attach($this); // exercise pt c)
        $this->removeFriendRequest($friendRequest);
    }

    /**
     * @param FriendRequest $friendRequest
     *
     * @throws FriendRequestException
     */
    public function decline(FriendRequest $friendRequest)
    {
        if(!$this->hasFriendRequest($friendRequest)) {
            throw new FriendRequestException('Friendrequest not found.', FriendRequestException::FRIENDREQUEST_NOT_FOUND);
        }
        $this->removeFriendRequest($friendRequest);
    }

    /**
     * @param User $friend
     *
     * @throws FriendRequestException
     */
    public function removeFriend(User $friend)
    {
        if(!$this->friends->contains($friend))
        {
            throw new FriendRequestException('Friend not found.', FriendRequestException::FRIEND_NOT_FOUND);
        }

        $this->friends->detach($friend);
    }

    /**
     * Not an official API method. Improves testability!
     *
     * @param User $friend
     *
     * @return bool
     */
    public function isFriendOf(User $friend) // hasFriend?
    {
        return $this->friends->contains($friend);
    }

    private function hasFriendRequest(FriendRequest $friendRequest)
    {
        return $this->friendRequests->contains($friendRequest);
    }

    private function removeFriendRequest(FriendRequest $friendRequest)
    {
        $this->friendRequests->detach($friendRequest);
    }

    private function addFriendFromFriendRequest(FriendRequest $friendRequest)
    {
        $this->friends->attach($friendRequest->getFrom());
    }
}
