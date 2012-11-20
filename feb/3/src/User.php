<?php

/**
 * Frage meinerseits: Wie loest man die zyklische Rekursion des confirm() und removeFriend() ohne
 * auf die private Attribute der fremden Userinstanz zuzugreifen (imho haesslich!) sondern ueber
 * die entsprechenden Methoden..?
 */
class User
{
    /**
     * @var array
     */
    private $friends = array();
    /**
     * @var array
     */
    private $friendRequests = array();


    /**
     * No business rule. Debugging purpose!
     *
     * @var String
     */
    private $username;

    public function __construct($username)
    {
        $this->username = $username;
    }

    /**
     * @param FriendRequest $friendRequest
     *
     * @throws FriendRequestException
     */
    public function addFriendRequest(FriendRequest $friendRequest)
    {
        /**
         * Not a business rule but makes sense
         */
        if ($friendRequest->getFrom() === $this) {
            throw new FriendRequestException('You can not add yourself as a Friend! Forever alone?', FriendRequestException::ADD_YOURSELF_AS_FRIEND);
        }

        // if ($this->hasFriend) ...

        if(in_array($friendRequest->getFrom(), $this->friends, true)) {
            throw new FriendRequestException('You already have this Friend!', FriendRequestException::FRIEND_ALREADY_EXISTS);
        }
        $this->friendRequests[] = $friendRequest;
    }

    /**
     * @param FriendRequest $friendRequest
     *
     * @throws FriendRequestException
     */
    public function confirm(FriendRequest $friendRequest)
    {
        // ... hasFriendRequest ...
        // ... removeFriendRequest ...
        // ... addFriend ...

        $friendRequestsKey = $this->getFriendRequestKey($friendRequest);
        if (!in_array($friendRequest->getFrom(), $this->friends, true)) {
            $this->friends[] = $friendRequest->getFrom();
            $friendRequest->getFrom()->friends[] = $this; // exercise pt c)
            unset($this->friendRequests[$friendRequestsKey]);
        }
    }

    /**
     * @param FriendRequest $friendRequest
     *
     * @throws FriendRequestException
     */
    public function decline(FriendRequest $friendRequest)
    {
        $friendRequestsKey = $this->getFriendRequestKey($friendRequest);
        unset($this->friendRequests[$friendRequestsKey]);
    }

    /**
     * @param User $friend
     *
     * @throws FriendRequestException
     */
    public function removeFriend(User $friend)
    {
        $key = array_search($friend, $this->friends, true);
        if ($key === false) {
            throw new FriendRequestException('Friend not found.', FriendRequestException::FRIEND_NOT_FOUND);
        }
        $remoteFriend = $this->friends[$key]; // exercise pt c)
        $remoteKey = array_search($remoteFriend, $remoteFriend->friends, true); // exercise pt c)
        unset($remoteFriend->friends[$remoteKey]); // exercise pt c)
        unset($this->friends[$key]);
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
        return in_array($friend, $this->friends, true);
    }

    /**
     * @param FriendRequest $friendRequest
     *
     * @return int
     * @throws FriendRequestException
     */
    private function getFriendRequestKey(FriendRequest $friendRequest){
        $key = array_search($friendRequest, $this->friendRequests);
        if ($key === false) {
            throw new FriendRequestException('Friendrequest not found.', FriendRequestException::FRIENDREQUEST_NOT_FOUND);
        }
        return $key;
    }
}
