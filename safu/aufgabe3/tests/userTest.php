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
        $this->setUser2->addFriendRequest($this->friendRequest);
        $this->assertTrue($this->setUser2->hasFriendRequest($this->friendRequest));
    }

    public function testConfirmAnFriendWorks()
    {
        $this->setUser2->addFriendRequest($this->friendRequest);
        $this->setUser2->confirm($this->friendRequest);
	$this->assertTrue($this->setUser2->hasFriend($this->setUser1));
    }

    public function testDeclineAnFriendWorks()
    {
        $this->setUser2->addFriendRequest($this->friendRequest);
	$this->setUser2->decline($this->friendRequest);
        $this->assertFalse($this->setUser2->hasFriendRequest($this->friendRequest));
                
    }

    public function testRemoveAnFriendWorks()
    {
        $this->setUser2->addFriendRequest($this->friendRequest);
        $this->setUser2->confirm($this->friendRequest);
        $this->setUser2->removeFriend($this->friendRequest);
	$this->assertTrue($this->setUser2->hasFriend($this->setUser1));
    }
    
    /**
     * @expectedException InvalidArgumentException 
     */
    public function testConstructFriendRequestWithSameUser()
    {
        $this->friendRequest = new FriendRequest($this->setUser1, $this->setUser1);
    }
    
    /**
     * @expectedException InvalidArgumentException
     */
    public function testAddFriendrequestItsMeExceptionWorks()
    {
        $this->friendRequest = new FriendRequest($this->setUser1, $this->setUser1);
        $this->setUser1->addFriendRequest($this->friendRequest);  
    }
    
    /**
     * @expectedException alreadyRequestException
     */
    public function testAddFreindrequestAllreadyFriendsExceptionWorks()
    {
        $this->setUser2->addFriendRequest($this->friendRequest);
        $this->setUser2->confirm($this->friendRequest);
        
        $this->setUser2->addFriendRequest($this->friendRequest);
        $this->setUser2->confirm($this->friendRequest);
    }
    
    /**
     * @expectedException itselfRequestException
     */
    public function testAddFriendrequestItIsNotForMeExceptionWorks()
    {
        $setUser3 = new User('Marlene');
        $this->friendRequest = new FriendRequest($this->setUser1, $setUser3);
        $this->setUser2->addFriendRequest($this->friendRequest);
    }
        
    /**
     * @expectedException notFoundRequestException
     */
    public function testRemoveFriendRequestCantFindFriendrequestExceptionWorks()
    {
        $this->setUser1->removeFriendRequest($this->friendRequest);
    }
    
   
     
}