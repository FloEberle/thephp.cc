<?php

class User
{
    
    public function __construct(){
        $this->userName = $userName;
        $this->friends = array(); 
    }
    
    
    /**
     * @param object $friendRequest
     */  
    public function addFriendRequest(FriendRequest $friendRequest)
    {
       /*
        * Kontrollieren ob man sich selber added oder ob der Freund schon bereits in der Liste vorhanden ist. 
        * */
        if($friendRequest['from'] == $this->userName){
            throw new Exception('Sie können sich selbst nicht als Freund hinzufügen.');
        }
        
        if(in_array($friendRequest['from'], $this->friends)){
            throw new Exception('Sie sind bereits schon ein Freund von: '. $this->userName);
        }
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