<?php
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
        if($friendRequest->getFrom() == $friendRequest->getTo()){
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
        if($friendRequest->getFrom() != $this->userName){
            return $this->friends[$friendRequest->getFrom()] = true;  
        }else{
            return $this->friends[$friendRequest->getTo()] = true;  
        }
        
        return false;
                   
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
                return true;
        }else{
        	throw new notFoundRequestException('Der zu entfernende Freund konnte nicht gefunden werden!');
        }
        
        
    }
}
