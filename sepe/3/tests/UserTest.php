<?php

class UserTest extends PHPUnit_Framework_TestCase
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

    public function testSettingAndGettingUserName()
    {
        $this->assertEquals('John', $this->user1->getUserName());
    }

    public function testBecomingFriendWorks()
    {
		$this->user2->addFriendRequest($this->friendRequest);
		$this->user2->confirm($this->friendRequest);
		$this->assertTrue($this->user2->hasFriend($this->user1));
    }
	
	/**
     * @expectedException UserException
	 * @expectedExceptionCode UserException::USER_ALREADY_FRIEND
     */
     public function testThrowsExceptionWhenAddRequestAndUserIsAlreadyFriend()
	 {
	 	$this->user2->addFriendRequest($this->friendRequest);
		$this->user2->confirm($this->friendRequest);
	 	$this->user2->addFriendRequest($this->friendRequest);
	 }
	
	/**
     * @expectedException UserException
	 * @expectedExceptionCode UserException::REQUEST_TO_CONFIRM_NOT_FOR_THIS_USER
     */
    public function testThrowsExceptionWhenConfirmedFriendRequestIsNotForThisUser()
    {
		$this->user2->addFriendRequest($this->friendRequest);
		$this->user1->confirm($this->friendRequest);
	}

    public function testDecliningFriendRequestWorks()
    {
    	$this->user2->addFriendRequest($this->friendRequest);
		$this->user2->decline($this->friendRequest);
		$this->assertFalse($this->user2->hasFriend($this->user1));
    }
	
	public function testDecliningFriendRequestWhichIsNotForThisUser ()
	{
		$friendRequest2 = new FriendRequest($this->user1, $this->user2);
		$this->assertEquals(null, $this->user2->decline($friendRequest2));
	}
	
	/**
     * @expectedException UserException
	 * @expectedExceptionCode UserException::REQUEST_TO_DECLINE_NOT_FOR_THIS_USER
     */
    public function testThrowsExceptionWhenDeclinedFriendRequestIsNotForThisUser()
    {
    	$this->user1->addFriendRequest($this->friendRequest);
		$this->user1->decline($this->friendRequest);
	}

    /**
     * @expectedException UserException
	 * @expectedExceptionCode UserException::REQUEST_TO_CONFIRM_NOT_FOR_THIS_USER
     */
    public function testThrowsExceptionWhenFriendRequestConfirmationOnNonFriend()
    {
        $user3 = new User('Jack');
        $request1 = new FriendRequest($this->user1, $this->user2);
        $user3->confirm($request1);
    }

    /**
     * @expectedException UserException
     */
    public function testThrowsExceptionWhenFriendRequestCDeclineOnNonFriend()
    {
        $user3 = new User('Jack');
        $request1 = new FriendRequest($this->user1, $this->user2);
        $user3->decline($request1);
    }
	
	public function testRemoveFriendWorks()
	{
		$this->user2->addFriendRequest($this->friendRequest);
		$this->user2->confirm($this->friendRequest);
		$this->user2->removeFriend($this->user1);
		$this->assertFalse($this->user2->hasFriend($this->user1));
	}
		
    /**
     * @expectedException UserException
     */
    public function testThrowsExceptionWhenFriendToRemoveIsNonFriend()
    {
        $this->user2->removeFriend($this->user1);
    }

    /**
     * @expectedException UserException
     */
    public function testThrowsExceptionWhenRequestingUserIsAlreadyInFriendslist()
    {
        $request = new FriendRequest($this->user1, $this->user2);
        $this->user1->addFriendRequest($request);
        $this->user1->confirm($request);
        //$this->user1->addFriendRequest($request);
    }
}