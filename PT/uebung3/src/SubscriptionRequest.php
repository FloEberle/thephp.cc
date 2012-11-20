<?php

class SubscriptionRequest
{
    private $from;
    private $to;

    public function __construct(User $from, User $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    public function getTo()
    {
        return $this->to;
    }
}
