<?php

class FriendRequest
{
    private $from;
    private $to;

    public function __construct(User $from, User $to)
    {
        if ($from === $to) {
            throw new SelfReferencingFriendRequestException('Freundschaft mit sich selbst, geht nicht');
        }
        $this->from = $from;
        $this->to = $to;
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

