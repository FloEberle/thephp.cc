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
     * @var String
     */
    public function __construct(User $from, User $to)
    {
        if($from === $to){
            throw new Exception('Both users are the same..');
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