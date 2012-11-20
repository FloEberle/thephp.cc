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

        if ($friendRequest->getFrom() === $this) {
            throw new itselfRequestException('Das geht nicht');
        }

        if ($friendRequest->getFrom() === $friendRequest->getTo()){
            throw new itselfRequestException('Freund mit sich selbst geht nicht');
        }

        if ($this->hasFriend($friendRequest->getFrom())) {
            throw new alreadyRequestException('Sie sind bereits schon ein Freund von: '. $this->userName);
        }

        $this->friendRequest[] = $friendRequest;
    }

    /**
     * @param object $friendRequest
     */
    public function confirm(FriendRequest $friendRequest)
    {
        $this->removeFriendRequest($friendRequest);
        $this->addFriend($friendRequest->getFrom());
    }

    private function removeFriendRequest(FriendRequest $friendRequest)
    {
        if (!$this->hasFriendRequest($friendRequest)) {
            // ...
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
    public function decline(FriendRequest $friendRequest)
    {
        // Plausibilitätsprüfungen

        $this->removeFriendRequest($friendRequest);
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
