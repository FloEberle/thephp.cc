<?php

class UserTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var User
     */
    private $from;

    /**
     * @var User
     */
    private $to;

    /**
     * @var FriendRequest
     */
    private $friendRequest;

    public function setUp()
    {
        $this->from = new User();
        $this->to = new User();
        $this->friendRequest = new FriendRequest($this->from, $this->to);
    }

    /**
     * Legal Friend Request with confirmation
     */
    public function testAddAndConfirmFriendRequest()
    {
        $this->to->addFriendRequest($this->friendRequest);
        $this->to->confirm($this->friendRequest);

        $this->assertTrue($this->to->isFriendOf($this->from));
        $this->assertTrue($this->from->isFriendOf($this->to));
        return $this->friendRequest;
    }

    /**
     * Legal Decline Request
     */
    public function testDeclineFriendRequest()
    {
        $this->to->addFriendRequest($this->friendRequest);
        $this->to->decline($this->friendRequest);

        $this->assertFalse($this->to->isFriendOf($this->from));
        $this->assertFalse($this->from->isFriendOf($this->to));
    }

    /**
     * User has no friends 'pseudotest'
     */
    public function testUserInitiallyHasNoFriends()
    {
        $this->assertFalse($this->to->isFriendOf($this->from));
        $this->assertFalse($this->from->isFriendOf($this->to));
    }

    /**
     * Legal Remove Friend
     * @depends testAddAndConfirmFriendRequest
     */
    public function testRemoveFriendUnfriendsTheUsers(FriendRequest $friendRequest)
    {
        $friendRequest->getTo()->removeFriend($friendRequest->getFrom());

        $this->assertFalse($friendRequest->getTo()->isFriendOf($friendRequest->getFrom()));
        //$this->assertFalse($friendRequest->getFrom()->isFriendOf($friendRequest->getTo()));

        return $this->to;
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

        $this->assertTrue($user->isFriendOf($this->from));
    }

    /**
     * Illegal Friend Request: Add yourself as a Friend
     * @expectedException FriendRequestException
     * @expectedExceptionCode FriendRequestException::ADD_YOURSELF_AS_FRIEND
     */
    public function testAddFriendRequestIllegal1()
    {
        $this->from->addFriendRequest($this->friendRequest);
    }

    /**
     * Illegal Friend Request: Friend already exists
     * @expectedException FriendRequestException
     * @expectedExceptionCode FriendRequestException::FRIEND_ALREADY_EXISTS
     */
    public function testAddFriendRequestIllegal2()
    {
        $this->to->addFriendRequest($this->friendRequest);
        $this->to->confirm($this->friendRequest);
        $this->to->addFriendRequest($this->friendRequest);
    }
    /**
     * Illegal Friend Request Confirmation: Doesn't exist
     * @expectedException FriendRequestException
     * @expectedExceptionCode FriendRequestException::FRIENDREQUEST_NOT_FOUND
     */
    public function testConfirmNotExistingFriendRequest()
    {
        $this->to->confirm($this->friendRequest);
    }

    /**
     * Illegal Friend Decline Confirmation: Doesn't exist
     * @expectedException FriendRequestException
     * @expectedExceptionCode FriendRequestException::FRIENDREQUEST_NOT_FOUND
     */
    public function testDeclineNotExistingFriendRequest()
    {
        $this->to->decline($this->friendRequest);
    }

    /**
     * Illegal Friend Remove: Doesn't exist
     * @expectedException FriendRequestException
     * @expectedExceptionCode FriendRequestException::FRIEND_NOT_FOUND
     */
    public function testRemoveNotExistingFriend()
    {
        $this->from->removeFriend($this->to);
    }

    /**
     * Legal Add Friend, but illegal add Friend on the opposite
     * @expectedException FriendRequestException
     * @expectedExceptionCode FriendRequestException::FRIEND_ALREADY_EXISTS
     */
    public function testRecursiveAddFriend()
    {
        $this->to->addFriendRequest($this->friendRequest);
        $this->to->confirm($this->friendRequest);
        $this->from->addFriendRequest(new FriendRequest($this->to, $this->from));
        $this->to->confirm($this->friendRequest);
    }
}