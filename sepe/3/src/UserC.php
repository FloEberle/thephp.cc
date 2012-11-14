<?php

class User
{
    private $friends = array();
    private $requests = array();
    private $declined = array();

    private $userName;

    public function addFriendRequest(FriendRequest $friendRequest)
    {
        if (empty($friendRequest)) {
            throw new InvalidArgumentException('No Parameter..');
        }
        $this->requests[$friendRequest->getId()] = $friendRequest->getFrom();
    }
    public function confirm(FriendRequest $friendRequest)
    {
        if (empty($friendRequest)) {
            throw new InvalidArgumentException('No Parameter..');
        }
        $this->friends[$friendRequest->getId()] = $friendRequest->getFrom()->getUserName();
        unset($this->requests[$friendRequest->getId()]);
    }
    public function decline(FriendRequest $friendRequest)
    {
        if (empty($friendRequest)) {
            throw new InvalidArgumentException('No Parameter..');
        }
        $this->declined[$friendRequest->getId()] = $friendRequest->getFrom()->getUserName();
        unset($this->requests[$friendRequest->getId()]);
    }
    public function removeFriend(User $friend)
    {
        if (empty($friend)) {
            throw new InvalidArgumentException('No Parameter..');
        }
        $pos = array_search($friend->getUserName(),$this->friends);
        unset($this->friends[$pos]);
    }
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }
    public function getUserName()
    {
        return $this->userName;
    }
}