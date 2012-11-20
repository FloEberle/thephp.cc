<?php

 class userTest extends PHPUnit_Framework_TestCase
{
   

    protected function setUp()
    {
        $setUser1 = new User("Samuel");
	$setUser2 = new User("Hugo");
    	$friendRequest = new FriendRequest($setUser1, $setUser2);
    }

    public function testAddingAnFriendRequestWorks ()
    {
        $this->assertEquals('', $setUser2-> addFriendRequest($friendRequest));
    }

    public function testConfirmAnFriendWorks()
    {
	$this->assertEquals('true', $setUser2->confirm($friendRequest));
    }

    public function testDeclineAnFriendWorks()
    {
	$this->assertEquals('$friendRequest == null', $setUser1->decline($friendRequest));
    }

    public function testRemoveAnFriendWorks()
    {
	$this->assertEquals('true', $setUser1->removeFriend('Hugo', $setUser1));
    }


