<?php

class User
{
    /**
     * @var array
     */
    private $friends = array();

    /**
     * @var array
     */
    private $requests = array();

    /**
     * @var array
     */
    private $declined = array();

    /**
    * @var String
    */
    private $userName;

    public function __construct($userName)
    {
        $this->setUserName($userName . 'test');
    }

    /**
     * @param FriendRequest $friendRequest
     * @throws InvalidArgumentException
     */
    public function addFriendRequest(FriendRequest $friendRequest)
    {
        if ($this->hasFriend($friendRequest->getFrom())) {
            throw new UserException('"' . $friendRequest->getFrom()->getUserName() . '" is already a friend', UserException::USER_ALREADY_FRIEND);
        }

        $this->requests[] = $friendRequest;
    }
	
	public function hasFriend(User $user)
	{
		foreach ($this->friends as $index => $friend) {
			if ($friend === $user) {
				return true;
			}
		}
		return false;
	}

    /**
     * @param FriendRequest $friendRequest
     * @throws InvalidArgumentException
     */
	public function confirm(FriendRequest $friendRequest)
    {
        if ($friendRequest->getTo() !== $this) {
            throw new UserException('FriendRequest is not for this User..', UserException::REQUEST_TO_CONFIRM_NOT_FOR_THIS_USER);
        }

        $this->addFriend($friendRequest->getFrom());
        $this->removeFriendRequest($friendRequest);
    }
	
	private function addFriend(User $user)
	{
		$this->friends[] = $user;
	}
	
	private function removeFriendRequest(FriendRequest $friendRequest)
	{
		foreach ($this->requests as $index => $request) {
            if ($request === $friendRequest) {
                unset($this->requests[$index]);
				return;
            }
	// Stelle in private Methode wird nie erreicht.
	// @codeCoverageIgnoreStart		
        }
	}
	// @codeCoverageIgnoreEnd
	
    /**
     * @param FriendRequest $friendRequest
     * @throws InvalidArgumentException
     */
    public function decline(FriendRequest $friendRequest)
    {
        if ($friendRequest->getTo() !== $this) {
            throw new UserException('FriendRequest is not for this User..', UserException::REQUEST_TO_DECLINE_NOT_FOR_THIS_USER);
        }
        $this->declined[] = $friendRequest;
        
		foreach ($this->requests as $index => $request) {
            if ($request === $friendRequest) {
                unset($this->requests[$index]);
				return;
            }
    	}
	}

    /**
     * @param User $friend
     * @throws InvalidArgumentException
     */
    public function removeFriend(User $friend)
    {
        if (!in_array($friend, $this->friends, true)) {
            throw new UserException('Not a Friend for this User..', UserException::FRIEND_TO_REMOVE_NOT_A_FRIEND);
        }
		
		foreach ($this->friends as $index => $request) {
            if ($request === $friend) {
                unset($this->friends[$index]);
				return;
            }
		// Diese Stelle wird nie erreicht weil wir aus Performance-Gründen mit return aus der Schleife springen.	
	    // @codeCoverageIgnoreStart
    	}
    }
	// @codeCoverageIgnoreEnd
	
    /**
     * @param $userName
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }
	
    /**
     * @return String
     */
    public function getUserName()
    {
        return $this->userName;
    }
}
