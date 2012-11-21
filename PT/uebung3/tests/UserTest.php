<?php

/**
 * @-covers User
 */
class UserTest extends PHPUnit_Framework_TestCase
{
    private $user;
    private $mockUser;
    private $friendRequest;

    public function setUp()
    {
        $this->user = new User('RealUser');

        $this->mockUser = $this->getMockBuilder('User')
            ->disableOriginalConstructor()
            ->getMock();

        $this->friendRequest = $this->getMockBuilder('FriendRequest')
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testGetNameWorks()
    {
        $this->assertEquals('RealUser', $this->user->getName());
    }

    public function testUserInitiallyHasNoFriends()
    {
        $this->assertEquals(0, $this->user->getNumberOfFriends());
    }

    public function testUserInitiallyHasNoSubscribers()
    {
        $this->assertEquals(0, $this->user->getNumberOfSubscribers());
    }

    public function testAddFriendRequestAddsFriendRequestToOtherUser()
    {
        $this->friendRequest->expects($this->any())
            ->method('getFrom')
            ->will($this->returnValue($this->mockUser));

        $this->friendRequest->expects($this->any())
            ->method('getTo')
            ->will($this->returnValue($this->user));

        $this->mockUser->expects($this->once())
            ->method('addFriendRequest')
            ->with($this->friendRequest);

        $this->user->addFriendRequest($this->friendRequest);
    }

    public function testConfirmingAFriendRequestMakesAFriend()
    {
        $this->friendRequest->expects($this->any())
            ->method('getFrom')
            ->will($this->returnValue($this->mockUser));

        $this->friendRequest->expects($this->any())
            ->method('getTo')
            ->will($this->returnValue($this->user));

        $this->mockUser->expects($this->once())
            ->method('addFriend')
            ->with($this->user);

        $this->user->addFriendRequest($this->friendRequest);
        $this->user->confirm($this->friendRequest);

        $this->assertTrue($this->user->hasFriend($this->mockUser));
        $this->assertFalse($this->user->hasFriendRequest($this->friendRequest));
        $this->assertEquals(1, $this->user->getNumberOfFriends());
    }

    public function testDeclineFriendRequestWorks()
    {
        $this->friendRequest->expects($this->any())
            ->method('getFrom')
            ->will($this->returnValue($this->mockUser));

        $this->friendRequest->expects($this->any())
            ->method('getTo')
            ->will($this->returnValue($this->user));

        $this->user->addFriendRequest($this->friendRequest);
        $this->user->decline($this->friendRequest);

        $this->assertFalse($this->user->hasFriendRequest($this->friendRequest));
        $this->assertEquals(0, $this->user->getNumberOfFriends());
    }

    public function testRemoveFriendWorks()
    {
        $this->friendRequest->expects($this->any())
            ->method('getFrom')
            ->will($this->returnValue($this->mockUser));

        $this->friendRequest->expects($this->any())
            ->method('getTo')
            ->will($this->returnValue($this->user));

        $this->mockUser->expects($this->any())
            ->method('hasFriend')
            ->with($this->user)
            ->will($this->returnValue(true));

        $this->mockUser->expects($this->once())
            ->method('removeFriend')
            ->with($this->user);

        $this->user->addFriendRequest($this->friendRequest);
        $this->user->confirm($this->friendRequest);

        $this->user->removeFriend($this->mockUser);

        $this->assertEquals(0, $this->user->getNumberOfFriends());
        $this->assertFalse($this->user->hasFriend($this->mockUser));
    }

    public function testSubscribingWorks()
    {
        $this->user->subscribe($this->mockUser);
        $this->assertTrue($this->user->isSubscriber($this->mockUser));
        $this->assertEquals(1, $this->user->getNumberOfSubscribers());
    }

    public function testAddFriendWorks()
    {
        $this->user->addFriend($this->mockUser);
        $this->assertTrue($this->user->hasFriend($this->mockUser));
        $this->assertEquals(1, $this->user->getNumberOfFriends());
    }

    public function testUserCanHaveTwoFriends()
    {
        $this->user->addFriend($this->mockUser);

        $mockUser = $this->getMockBuilder('User')
            ->disableOriginalConstructor()
            ->getMock();

        $this->user->addFriend($mockUser);

        $this->assertTrue($this->user->hasFriend($this->mockUser));
        $this->assertTrue($this->user->hasFriend($mockUser));
        $this->assertEquals(2, $this->user->getNumberOfFriends());
    }

    /**
     * @expectedException missingFriendRequestException
     */
    public function testConfirmWithoutFriendRequestThrowsException()
    {
        $this->user->confirm($this->friendRequest);
    }

    /**
     * @expectedException invalidFriendRemovalException
     */
    public function testRemoveNonExistentFriendThrowsException()
    {
        $this->user->removeFriend($this->mockUser);
    }

    /**
     * @expectedException missingFriendRequestException
     */
    public function testDeclineNonExistentFriendRequestThrowsException()
    {
        $this->user->decline($this->friendRequest);
    }

    /**
     * @expectedException ForeignFriendRequestException
     */
    public function testAddingFriendRequestToAnotherUserThrowsException()
    {
        $this->friendRequest->expects($this->any())
            ->method('getTo')
            ->will($this->returnValue($this->mockUser));

        $this->user->addFriendRequest($this->friendRequest);
    }
}
