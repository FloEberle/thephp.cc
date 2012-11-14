<?php

class User
{
    private $friends = array();
    private $requests = array();
    private $declined = array();

    private $userName;

    public function addFriendRequest(FriendRequest $friendRequest)
    {
        $this->requests[$friendRequest->getId()] = $friendRequest->getFrom();
    }
    public function confirm(FriendRequest $friendRequest)
    {
        $this->friends[$friendRequest->getId()] = $friendRequest->getFrom()->getUserName();
        unset($this->requests[$friendRequest->getId()]);
        $friendRequest->getFrom()->friends[$friendRequest->getId()] = $friendRequest->getTo()->getUserName();
    }
    public function decline(FriendRequest $friendRequest)
    {
        $this->declined[$friendRequest->getId()] = $friendRequest->getFrom()->getUserName();
        unset($this->requests[$friendRequest->getId()]);
    }
    public function removeFriend(User $friend)
    {
        $pos = array_search($friend->getUserName(),$this->friends);
        unset($this->friends[$pos]);
        $pos = array_search($this->getUserName(),$friend->friends);
        unset($friend->friends[$pos]);
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
