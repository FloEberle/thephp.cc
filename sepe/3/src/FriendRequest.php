<?php

class FriendRequest
{
    /**
     * @var String
     */
    private $from;

    /**
     * @var String
     */
    private $to;

    /**
     * @var String
     */
    private $id;

    /**
     * @var String
     */
    public function __construct(User $from, User $to)
    {
        $this->from = $from;
        $this->to = $to;
        $this->id = rand(1,10000000);
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

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}