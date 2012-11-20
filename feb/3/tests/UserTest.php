<?php

class UserTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var User
     */
    private $user1; // from

    /**
     * @var User
     */
    private $user2; // to

    /**
     * @var FriendRequest
     */
    private $friendRequest;

    public function setUp()
    {
        $this->user1 = new User();
        $this->user2 = new User();
        $this->friendRequest = new FriendRequest($this->user1, $this->user2);
    }

    /**
     * Legal Friend Request with confirmation
     */
    public function testAddAndConfirmFriendRequest()
    {
        $this->user2->addFriendRequest($this->friendRequest);
        $this->user2->confirm($this->friendRequest);

        $this->assertTrue($this->user2->isFriendOf($this->user1));
        $this->assertTrue($this->user1->isFriendOf($this->user2));
    }

    /**
     * Legal Decline Request
     */
    public function testDeclineFriendRequest()
    {
        $this->user2->addFriendRequest($this->friendRequest);
        $this->user2->decline($this->friendRequest);

        $this->assertFalse($this->user2->isFriendOf($this->user1));
        $this->assertFalse($this->user1->isFriendOf($this->user2));
    }

    public function testUserInitiallyHasNoFriends()
    {

    }

    /**
     * Legal Remove Friend
     */
    public function testRemoveFriendUnfriendsTheUsers()
    {
        $this->user2->addFriendRequest($this->friendRequest);
        $this->user2->confirm($this->friendRequest);
        $this->user2->removeFriend($this->user1);

        $this->assertFalse($this->user2->isFriendOf($this->user1));
        $this->assertFalse($this->user1->isFriendOf($this->user2));

        return $this->user2;
    }

    /**
     * Legal Add Friend, Remove Friend and add Again Friend (Tests recursive adding/removing)
     * @depends testRemoveFriendUnfriendsTheUsers
     */
    public function testAddAndRemoveFriendAndAddAgain(User $user)
    {
        //Now it should be legal to add the friend again
        $user->addFriendRequest($this->friendRequest);
        $user->confirm($this->friendRequest);

        $this->assertTrue($user->isFriendOf($this->user1));
    }

    /**
     * Illegal Friend Request: Add yourself as a Friend
     * @expectedException FriendRequestException
     * @expectedExceptionCode FriendRequestException::ADD_YOURSELF_AS_FRIEND
     */
    public function testAddFriendRequestIllegal1()
    {
        $this->user1->addFriendRequest($this->friendRequest);
    }

    /**
     * Illegal Friend Request: Friend already exists
     * @expectedException FriendRequestException
     * @expectedExceptionCode FriendRequestException::FRIEND_ALREADY_EXISTS
     */
    public function testAddFriendRequestIllegal2()
    {
        $this->user2->addFriendRequest($this->friendRequest);
        $this->user2->confirm($this->friendRequest);
        $this->user2->addFriendRequest($this->friendRequest);
    }
    /**
     * Illegal Friend Request Confirmation: Doesn't exist
     * @expectedException FriendRequestException
     * @expectedExceptionCode FriendRequestException::FRIENDREQUEST_NOT_FOUND
     */
    public function testConfirmNotExistingFriendRequest()
    {
        $this->user2->confirm($this->friendRequest);
    }

    /**
     * Illegal Friend Decline Confirmation: Doesn't exist
     * @expectedException FriendRequestException
     * @expectedExceptionCode FriendRequestException::FRIENDREQUEST_NOT_FOUND
     */
    public function testDeclineNotExistingFriendRequest()
    {
        $this->user2->decline($this->friendRequest);
    }

    /**
     * Illegal Friend Remove: Doesn't exist
     * @expectedException FriendRequestException
     * @expectedExceptionCode FriendRequestException::FRIEND_NOT_FOUND
     */
    public function testRemoveNotExistingFriend()
    {
        $this->user1->removeFriend($this->user2);
    }

    /**
     * Legal Add Friend, but illegal add Friend on the opposite
     * @expectedException FriendRequestException
     * @expectedExceptionCode FriendRequestException::FRIEND_ALREADY_EXISTS
     */
    public function testRecursiveAddFriend()
    {
        $this->user2->addFriendRequest($this->friendRequest);
        $this->user2->confirm($this->friendRequest);
        $this->user1->addFriendRequest(new FriendRequest($this->user2, $this->user1));
        $this->user2->confirm($this->friendRequest);
    }
}