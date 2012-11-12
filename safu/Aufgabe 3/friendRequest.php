<?php

class User
{
      
    public function addFriendRequest(FriendRequest $friendRequest)
    {
        
    }
    
    public function confirm(FriendRequest $friendRequest)
    {
        $friendRequest['status'] = true;
    }
    
    public function decline(FriendRequest $friendRequest)
    {
        $friendRequest['status'] = false;
    }    
    
    public function removeFriend(User $friendRequest)
    {
        $friendRequest['status'] = false; 
        
    }
}

class FriendRequest
{  
    /**
     * @var string
     */
    private $from; 
    
    /**
     * @var int
     */
    private $status;
    
    
    /**
     * @param string $from 
     * @param string $to
     * @param boolean $status
     */
    public function __construct(User $from, User $to)
    {
        $this->from = $from;
        $this->to = $to;
        $this->status = null; 
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