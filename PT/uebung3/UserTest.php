<?php

require 'User.php';

Class UserTest extends PHPUnit_Framework_TestCase
{
    /*
    public function setUp()
    {

    }
    */

    public function testFriendship()
    {
        $john = new User('1', 'john');
        $kasperle = new User('2', 'kasperle');
        $friendRequest = new FriendRequest($john, $kasperle);
        $kasperle->addFriendRequest($friendRequest);
        $kasperle->confirm($friendRequest);
        $this->assertTrue($john->hasFriend($kasperle));
        $this->assertTrue($kasperle->hasFriend($john));
    }

    public function testSubscription ()
    {
        $john = new User('1', 'john');
        $kasperle = new User('2', 'kasperle');
        $subscriptionRequest = new SubscriptionRequest($john, $kasperle);
        $john->addSubscription($subscriptionRequest);
        $this->assertTrue($john->hasSubscription($kasperle));
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testGetFriendsWithoutRequestsThrowsException()
    {
        $john = new User('1', 'john');
        $kasperle = new User('2', 'kasperle');
        $friendRequest = new FriendRequest($john, $kasperle);
        $kasperle->confirm($friendRequest);
    }
    /**
     * @expectedException InvalidArgumentException
     */
    public function testRemoveNonExistentFriendThrowsException()
    {
        $john = new User('1', 'john');
        $kasperle = new User('2', 'kasperle');
        $kasperle->removeFriend($john);

    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testDeclineNonExistentFriendRequestThrowsException()
    {
        $john = new User('1', 'john');
        $kasperle = new User('2', 'kasperle');
        $friendRequest = new FriendRequest($john, $kasperle);
        $kasperle->decline($friendRequest);
    }

        /**
         * @expectedException InvalidArgumentException
         */
        public function testRemoveFriend()
    {
        $john = new User('1', 'john');
        $kasperle = new User('2', 'kasperle');
        $friendRequest = new FriendRequest($john, $kasperle);
        $kasperle->decline($friendRequest);

    }

        /**
        * @expectedException InvalidArgumentException
         */
        public function testAddYourselfAsFriendThrowsException()
        {
            $john = new User('1', 'john');
            $friendRequest = new FriendRequest($john, $john);
            $john->addFriendRequest($friendRequest);
        }

}
