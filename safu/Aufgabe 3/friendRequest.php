<?php

require __DIR__ . '/FriendRequestException.php';

class User
{
	
	/**
	* @var string 
	*/
	public $userName;
	
	/**
	* @var array		
	*/
       private $friends;


    /**
     *  @param string $userName    
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
        if($friendRequest->from == $this->userName){
            throw new itselfRequestException('Sie können sich selbst nicht als Freund hinzufügen.');
        }
        
        if(isset($this->friends[$friendRequest->getFrom()])){
            throw new alreadyRequestException('Sie sind bereits schon ein Freund von: '. $this->userName);
        }
    }
    
    /**
    * @param object $friendRequest
    */
    public function confirm(FriendRequest $friendRequest)
    {
        $this->friends[$friendRequest->from] = true;     
        return true;           
    }
    
    /**
    * @param object $friendRequest
    */
    public function decline(FriendRequest &$friendRequest)
    {
        return $friendRequest = null;      
    }    
    
    /**
    * @param object $friendRequest
    */
    public function removeFriend($friend, User $friendRequest)
    {
        if(array_key_exists($friend, $friendRequest->friends)){
        	unset($friendRequest->friends[$friend]);
        }else{
        	throw new notFoundRequestException('Der zu entfernende Freund konnte nicht gefunden werden!');
        }
        
        
    }
}

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
    public function __construct($from, $to)
    {
        $this->from = $from;
        $this->to = $to;
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