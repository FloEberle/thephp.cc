<?php

class FriensRequestTest extends PHPUnit_Framework_TestCase
{
	private $user1;
    private $user2;
    private $friendRequest;

    protected function setUp()
    {
        $this->user1 = new User('John');
        $this->user2 = new User('Jane');
        $this->friendRequest = new FriendRequest($this->user1, $this->user2);
    }
	
	// FriendRequest
	public function testGetFriendRequestFromWorks()
	{
		$this->assertEquals($this->user1, $this->friendRequest->getFrom());
	}
	
	public function testGetFriendRequestToWorks()
	{
		$this->assertEquals($this->user2, $this->friendRequest->getTo());
	}
	
	/**
     * @expectedException Exception
     */
    public function testThrowsExceptionWhenConfirmedFriendRequestIsNotForThisUser()
    {
    	$this->friendRequest = new FriendRequest($this->user1, $this->user1);	
	}
}
