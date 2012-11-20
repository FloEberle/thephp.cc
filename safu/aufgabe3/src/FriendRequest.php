<?php

class FriendRequest
{
    /**
     * @var User
     */
    public $from;

    /**
     * @var User
     */
    private $to;

    /**
     * @param string $from
     * @param string $to
     */
    public function __construct(User $from, User $to)
    {
        if ($from === $to){
            throw new InvalidArgumentException('Freund mit sich selbst geht nicht');
        }

        $this->from = $from;
        $this->to = $to;
    }

    /**
     * @returns User $from
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @returns User $to
     */
    public function getTo()
    {
        return $this->to;
    }
}