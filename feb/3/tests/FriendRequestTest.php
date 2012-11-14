<?php
class FriendRequestTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->_user1 = new User();
        $this->_user2 = new User();
        $this->_friendRequest = new FriendRequest($this->_user1, $this->_user2);
    }
    public function testGetters()
    {
        $this->assertSame($this->_user1, $this->_friendRequest->getFrom());
        $this->assertSame($this->_user2, $this->_friendRequest->getTo());
    }

    /**
     * @expectedException FriendRequestException
     * @expectedExceptionCode FriendRequestException::FRIENDREQUEST_REQUIRES_DIFFERENT_USERS
     */
    public function testGetInvalidInstance()
    {
        new FriendRequest($this->_user1, $this->_user1);
    }
}