<?php

Class UserTest extends PHPUnit_Framework_TestCase
{
    private $john;
    private $kasperle;

    public function setUp()
    {
        $this->john = new User('john');
        $this->kasperle = new User('kasperle');
    }

    public function testConfirmingAFriendRequestMakesFriends()
    {
        $friendRequest = new FriendRequest($this->john, $this->kasperle);
        $this->kasperle->addFriendRequest($friendRequest);
        $this->kasperle->confirm($friendRequest);

        $this->assertTrue($this->john->hasFriend($this->kasperle));
        $this->assertTrue($this->kasperle->hasFriend($this->john));

        return $friendRequest;
    }

    public function testSubscription()
    {
        $subscriptionRequest = new SubscriptionRequest($this->john, $this->kasperle);
        $this->john->addSubscription($subscriptionRequest);
        $this->assertTrue($this->john->hasSubscription($this->kasperle));
    }

    /**
     * @expectedException missingFriendRequestException
     */
    public function testConfirmWithoutFriendRequestAddedThrowsException()
    {
        $friendRequest = new FriendRequest($this->john, $this->kasperle);
        $this->kasperle->confirm($friendRequest);
    }

    /**
     * @expectedException invalidFriendRemovalException
     */
    public function testRemoveNonExistentFriendThrowsException()
    {
        $this->kasperle->removeFriend($this->john);
    }

    /**
     * @expectedException missingFriendRequestException
     */
    public function testDeclineNonExistentFriendRequestThrowsException()
    {
        $friendRequest = new FriendRequest($this->john, $this->kasperle);
        $this->kasperle->decline($friendRequest);
    }

    public function testDeclineFriendRequestWorks()
    {
        $friendRequest = new FriendRequest($this->john, $this->kasperle);
        $this->kasperle->addFriendRequest($friendRequest);
        $this->assertTrue($this->kasperle->decline($friendRequest));
    }

    /**
     * @expectedException SelfReferencingFriendRequestException
     */
    public function testAddYourselfAsFriendThrowsException()
    {
        $friendRequest = new FriendRequest($this->john, $this->john);
        $this->john->addFriendRequest($friendRequest);
    }

    /**
     * @param FriendRequest $friendRequest
     * @depends testConfirmingAFriendRequestMakesFriends
     */
    public function testRemoveFriendWorks(FriendRequest $friendRequest)
    {
        $john = $friendRequest->getFrom();
        $kasperle = $friendRequest->getTo();

        $john->removeFriend($kasperle);

        $this->assertFalse($kasperle->hasFriend($john));
        $this->assertFalse($john->hasFriend($kasperle));
    }

    /**
     * @expectedException foreignFriendRequestException
     */
    public function testAddForeignFriendRequestThrowsException()
    {
        $alien = new User ('alien');
        $friendRequest = new FriendRequest($this->kasperle, $alien);
        $this->john->addFriendRequest($friendRequest);
    }

    /**
     * @expectedException SelfReferencingFriendRequestException
     */
    public function testCreateMyselfAsTargetForFriendRequestThrowsException()
    {
        $friendRequest = new FriendRequest($this->john, $this->john);
        $this->john->addFriendRequest($friendRequest);
    }
}
