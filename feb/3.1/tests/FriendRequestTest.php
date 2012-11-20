<?php
class FriendRequestTest extends PHPUnit_Framework_TestCase
{
    private $user1;
    private $user2;

    public function setUp()
    {
        $this->user1 = new User();
        $this->user2 = new User();
        $this->friendRequest = new FriendRequest($this->user1, $this->user2);
    }

    public function testGetters()
    {
        $this->assertSame($this->user1, $this->friendRequest->getFrom());
        $this->assertSame($this->user2, $this->friendRequest->getTo());
    }

    /**
     * @expectedException FriendRequestException
     * @expectedExceptionCode FriendRequestException::FRIENDREQUEST_REQUIRES_DIFFERENT_USERS
     */
    public function testFriendRequestWithIdenticalFromAndToUserThrowsException()
    {
        new FriendRequest($this->user1, $this->user1);
    }
}