<?php

class FriendRequest
{
    /**
     * @var User
     */
    private $from;
    /**
     * @var User
     */
    private $to;

    /**
     * @param User $from
     * @param User $to
     */
    public function __construct(User $from, User $to)
    {
        if($from === $to){
            throw new FriendRequestException('Friendrequest requires two different Users', FriendRequestException::FRIENDREQUEST_REQUIRES_DIFFERENT_USERS);
        }
        $this->from = $from;
        $this->to = $to;
    }

    /**
     * @return User
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @return User
     */
    public function getTo()
    {
        return $this->to;
    }
}
