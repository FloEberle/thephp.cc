<?php

class User
{
	
	/**
	* @var string 
	*/
	private $userName;
	
	/**
	* @var array		
	*/
	private $friends;


    /**
	* @param string $userName    
    */
    public function __construct($userName){
        $this->userName = $userName;
        $this->friends = array(); 
    }
    
    
    /**
     * @param object $friendRequest
     */  
    public function addFriendRequest(FriendRequest $friendRequest)
    {       
        if($friendRequest['from'] == $this->userName){
            throw new Exception('Sie können sich selbst nicht als Freund hinzufügen.');
        }
        
        if(in_array($friendRequest['from'], $this->friends)){
            throw new Exception('Sie sind bereits schon ein Freund von: '. $this->userName);
        }
    }
    
    /**
    * @param object $friendRequest
    */
    public function confirm(FriendRequest $friendRequest)
    {
        array_push($this->friends, 'from', $friendRequest['from']);     
        return true;           
    }
    
    /**
    * @param object $friendRequest
    */
    public function decline(FriendRequest $friendRequest)
    {
	    unset($friendRequest);
        return true;       
    }    
    
    /**
    * @param object $friendRequest
    */
    public function removeFriend(User $friendRequest)
    {
        $arrayElement = in_array($this->friends, $friendRequest);
        if(empty($arrayElement)){
        	unset($arrayElement);
        	return true;
        }else{
        	throw new Exception('Der zu entfernende Freund konnte nicht gefunden werden!');
	        return false;
        }
        
        
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
	* @var string    
    */
    private $to;
    
    
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