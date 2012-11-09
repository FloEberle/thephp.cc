<?php
require_once __DIR__ . '/../src/User.php';
require_once __DIR__ . '/../src/FriendRequest.php';
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
     */
    public function testGetInvalidInstance()
    {
        new FriendRequest($this->_user1, $this->_user1);
    }
}