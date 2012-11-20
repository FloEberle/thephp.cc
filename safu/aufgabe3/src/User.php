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
    private $friends = array();

    /**
     * @var array
     */
    private $friendRequests = array();

    /**
     *  @param string $userName
     */
    public function __construct($userName)
    {
        $this->userName = $userName;
    }

    /**
     * @param object $friendRequest
     */
    public function addFriendRequest(FriendRequest $friendRequest)
    {
        if ($friendRequest->getTo() !== $this) {
            throw new itselfRequestException('Du sprichst nicht mit mir');
        }
       
        if ($this->hasFriend($friendRequest->getFrom())) {
            throw new alreadyRequestException('Sie sind bereits schon ein Freund von: '. $this->userName);
        }

        $this->friendRequests[] = $friendRequest;
    }

    /**
     * @param object $friendRequest
     */
    public function confirm(FriendRequest $friendRequest)
    {
        $this->removeFriendRequest($friendRequest);
        $this->addFriend($friendRequest->getFrom());
    }
    
    public function addFriend(User $user)
    {
        $this->friends[] = $user;
    }
    
    /**
     * @param object $friendRequest
     */
    public function removeFriendRequest(FriendRequest $friendRequest)
    {
        if (!$this->hasFriendRequest($friendRequest)) {
            throw new notFoundRequestException('Request konnte nicht gefunden werden!');
        }

        foreach ($this->friendRequests as $index => $request) {
            if ($request === $friendRequest) {
                unset($this->friendRequests[$index]);
            }
        }
    }

    /**
     * @param object $friendRequest
     */
    public function hasFriendRequest(FriendRequest $friendRequest)
    {
        return in_array($friendRequest, $this->friendRequests, true);
    }
    
    /**
     * @param $from
     */
    public function hasFriend(User $user)
    {
        return in_array($user, $this->friends, true);
    }
    
    /**
     * @param object $friendRequest
     */
    public function decline(FriendRequest $friendRequest)
    {
        $this->removeFriendRequest($friendRequest);
    }

    /**
     * @param object $friendRequest
     */
    public function removeFriend(User $user)
    {
        if(!$this->hasFriend($user)){
            throw new notFoundRequestException('Der Freund konnte nicht gefunden werden!');
        } 
        
        foreach ($this->friends as $index => $friend) {
            if ($friend === $friend) {
                unset($this->friends[$index]);
            }
        }
    }
}
