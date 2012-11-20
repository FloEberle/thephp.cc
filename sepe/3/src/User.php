<?php

class User
{
    /**
     * @var array
     */
    private $friends = array();

    /**
     * @var array
     */
    private $requests = array();

    /**
     * @var array
     */
    private $declined = array();

    /**
    * @var String
    */
    private $userName;

    /**
     * @param FriendRequest $friendRequest
     * @throws InvalidArgumentException
     */
    public function addFriendRequest(FriendRequest $friendRequest)
    {
        if (array_search($friendRequest->getFrom(),$this->friends)==true) {
            throw new InvalidArgumentException('Friend still in Friendslist ..');
        }
        $this->requests[$friendRequest->getId()] = $friendRequest->getFrom();
    }

    /**
     * @param FriendRequest $friendRequest
     * @throws InvalidArgumentException
     */
    public function confirm(FriendRequest $friendRequest)
    {
        if ($friendRequest->getTo() !== $this) {
            throw new InvalidArgumentException('FriendRequest is not for this User..');
        }
        $this->friends[$friendRequest->getId()] = $friendRequest->getFrom()->getUserName();
        unset($this->requests[$friendRequest->getId()]);
        $friendRequest->getFrom()->friends[$friendRequest->getId()] = $friendRequest->getTo()->getUserName();
    }

    /**
     * @param FriendRequest $friendRequest
     * @throws InvalidArgumentException
     */
    public function decline(FriendRequest $friendRequest)
    {
        if ($friendRequest->getTo() !== $this) {
            throw new InvalidArgumentException('FriendRequest is not for this User..');
        }
        $this->declined[$friendRequest->getId()] = $friendRequest->getFrom()->getUserName();
        unset($this->requests[$friendRequest->getId()]);
    }

    /**
     * @param User $friend
     * @throws InvalidArgumentException
     */
    public function removeFriend(User $friend)
    {
        if (array_search($friend->getUserName(),$this->friends)==false) {
            throw new InvalidArgumentException('Not a Friend for this User..');
        }
        $pos = array_search($friend->getUserName(),$this->friends);
        unset($this->friends[$pos]);
        $pos = array_search($this->getUserName(),$friend->friends);
        unset($friend->friends[$pos]);
    }

    /**
     * @param $userName
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }
    public function getUserName()
    {
        return $this->userName;
    }
}
