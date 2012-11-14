<?php

class FriendRequest
{
    private $from;
    private $to;
    private $id;

    public function __construct(User $from, User $to)
    {
        $this->from = $from;
        $this->to = $to;
        $this->id = rand(1,10000000);
    }
    public function getFrom()
    {
        return $this->from;
    }
    public function getTo()
    {
        return $this->to;
    }

    public function getId()
    {
        return $this->id;
    }
}