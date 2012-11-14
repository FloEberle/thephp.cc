<?php
class FriendRequest
{  
    /**
     * @var string
     */
    public $from; 
    
    /**
    * @var string    
    */
    private $to;
    
    
    /**
     * @param string $from 
     * @param string $to
     */
    public function __construct(User $from, User $to)
    {
        $this->from = $from->userName;
        $this->to = $to->userName;
    }
    
    /**
    * @returns string $from
    */
    public function getFrom()
    {
        return $this->from;
    }
    
    /**
    * @returns string $to     
    */
    public function getTo()
    {
        return $this->to;
    }
}