<?php
 class UserTest extends PHPUnit_Framework_TestCase
{
   /**
    * @var $friendRequest Object
    */
   private $friendRequest;

   /**
    * @var $setUser1 Object
    */
   private $setUser1;
   
   /**
    * @var $setUser2 Object
    */
   private $setUser2;
   
    protected function setUp()
    {
        $this->setUser1 = new User("Samuel");
	$this->setUser2 = new User("Hugo");
    	$this->friendRequest = new FriendRequest($this->setUser1, $this->setUser2);
    }

    public function testAddingAnFriendRequestWorks()
    {
        $this->assertEquals('', $this->setUser2->addFriendRequest($this->friendRequest));
    }

    public function testConfirmAnFriendWorks()
    {
	$this->assertEquals('true', $this->setUser2->confirm($this->friendRequest));
    }

    public function testDeclineAnFriendWorks()
    {
	$this->assertEquals('$this->friendRequest == null', $this->setUser1->decline($this->friendRequest));
    }

    public function testRemoveAnFriendWorks()
    {
	$this->assertEquals('true', $this->setUser1->removeFriend('Hugo', $this->setUser1));
    }
}