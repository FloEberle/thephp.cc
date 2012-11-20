<?php

class UserTest extends PHPUnit_Framework_TestCase
{

    private $user1;
    private $user2;
    private $friendRequest;

    protected function setUp()
    {
        $this->user1 = new User();
        $this->user2 = new User();
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
    public function testGetFriendRequestIdWorks()
    {
        $this->assertGreaterThanOrEqual(1, $this->friendRequest->getId());
        $this->assertLessThanOrEqual(10000000, $this->friendRequest->getId());
    }

    // User
    public function testSettingAndGettingUserName()
    {
        $this->user1->setUserName('Horst');
        $this->assertEquals('Horst', $this->user1->getUserName());
    }

    public function testBecomingFriendWorks()
    {
    }

    public function testDecliningFriendRequestWorks()
    {
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testThrowsExceptionWhenFriendRequestConfirmationOnNonFriend()
    {
        $user3 = new User();
        $request1 = new FriendRequest($this->user1, $this->user2);
        $user3->confirm($request1);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testThrowsExceptionWhenFriendRequestCDeclineOnNonFriend()
    {
        $user3 = new User();
        $request1 = new FriendRequest($this->user1, $this->user2);
        $user3->decline($request1);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testThrowsExceptionWhenFriendToRemoveIsNonFriend()
    {
        $this->user2->removeFriend($this->user1);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testThrowsExceptionWhenRequestingUserIsAlreadyInFriendslist()
    {
        $request = new FriendRequest($this->user1, $this->user2);
        $this->user1->addFriendRequest($request);
        $this->user1->confirm($request);
        $this->user1->addFriendRequest($request);
    }
}
