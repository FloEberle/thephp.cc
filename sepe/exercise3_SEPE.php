<?php
/**
 * Uebungsaufgabe 3
 *
 */

$user1 = new User();
$user2 = new User();

$request1 = new FriendRequest($user1,$user2);

class User
{
    private $friends = array();
    private $requests = array();
    private $declined = array();

    public function addFriendRequest(FriendRequest $friendRequest)
    {
        $this->requests = $friendRequest->getFrom();
    }

    public function confirm(FriendRequest $friendRequest)
    {
        $this->friends = $friendRequest->getFrom();
        $pos = array_search($this->requests,$friendRequest->getFrom());
        unset($this->requests[$pos]);
    }

    public function decline(FriendRequest $friendRequest)
    {
        $this->declined = $friendRequest->getFrom();
        $pos = array_search($this->requests,$friendRequest->getFrom());
        unset($this->requests[$pos]);
    }

    public function removeFriend(User $friend)
    {
        $pos = array_search($friend,$friend->friends);
        unset($friend->friends[$pos]);
    }
}


class FriendRequest
{
    private $from;
    private $to;

    public function __construct(User $from, User $to)
    {
        $this->$from = $from;
        $this->$to = $to;
    }

    public function getFrom()
    {
        return $this->from;
    }

    public function getTo()
    {
        return $this->to;
    }
}