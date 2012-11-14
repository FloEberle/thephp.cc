<?php
class UserTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->_user1 = new User();
        $this->_user2 = new User();
        $this->_friendRequest = new FriendRequest($this->_user1, $this->_user2);
    }

    /**
     * Legal Friend Request
     */
    public function testAddFriendRequest()
    {
        $this->_user2->addFriendRequest($this->_friendRequest);
    }

    /**
     * Legal Confirm Request
     */
    public function testConfirmFriendRequest()
    {
        $this->_user2->addFriendRequest($this->_friendRequest);
        $this->_user2->confirm($this->_friendRequest);
    }

    /**
     * Legal Decline Request
     */
    public function testDeclineFriendRequest()
    {
        $this->_user2->addFriendRequest($this->_friendRequest);
        $this->_user2->decline($this->_friendRequest);
    }

    /**
     * Legal Remove Friend Request
     */
    public function testRemoveFriendRequest()
    {
        $this->_user2->addFriendRequest($this->_friendRequest);
        $this->_user2->confirm($this->_friendRequest);
        $this->_user2->removeFriend($this->_user1);
    }

    /**
     * Legal Add Friend, Remove Friend and add Again Friend (Tests recursive adding/removing)
     */
    public function testRecursiveFriend()
    {
        $this->_user2->addFriendRequest($this->_friendRequest);
        $this->_user2->confirm($this->_friendRequest);
        $this->_user2->removeFriend($this->_user1);
        $this->_user2->addFriendRequest($this->_friendRequest);
        $this->_user2->confirm($this->_friendRequest);
    }

    /**
     * Illegal Friend Request: Add yourself as a Friend
     * @expectedException FriendRequestException
     */
    public function testAddFriendRequestIllegal1()
    {
        $this->_user1->addFriendRequest($this->_friendRequest);
    }

    /**
     * Illegal Friend Request: Friend already exists
     * @expectedException FriendRequestException
     */
    public function testAddFriendRequestIllegal2()
    {
        $this->_user2->addFriendRequest($this->_friendRequest);
        $this->_user2->confirm($this->_friendRequest);
        $this->_user2->addFriendRequest($this->_friendRequest);
    }
    /**
     * Illegal Friend Request Confirmation: Doesn't exist
     * @expectedException FriendRequestException
     */
    public function testConfirmNotExistingFriendRequest()
    {
        $this->_user2->confirm($this->_friendRequest);
    }

    /**
     * Illegal Friend Decline Confirmation: Doesn't exist
     * @expectedException FriendRequestException
     */
    public function testDeclineNotExistingFriendRequest()
    {
        $this->_user2->decline($this->_friendRequest);
    }

    /**
     * Illegal Friend Remove: Doesn't exist
     * @expectedException FriendRequestException
     */
    public function testRemoveNotExistingFriend()
    {
        $this->_user1->removeFriend($this->_user2);
    }

    /**
     * Legal Add Friend, but illegal add Friend on the "other Side"
     * @expectedException FriendRequestException
     */
    public function testRecursiveAddFriend()
    {
        $this->_user2->addFriendRequest($this->_friendRequest);
        $this->_user2->confirm($this->_friendRequest);
        $this->_user1->addFriendRequest(new FriendRequest($this->_user2, $this->_user1));
        $this->_user2->confirm($this->_friendRequest);
    }
}

