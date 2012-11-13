<?php

class UserTest extends PHPUnit_Framework_TestCase
{
    private $user;

    protected function setUp()
    {
        $this->user = new User(1, 'the-email', 'the-realname');
    }

    public function testGetEmailWorks()
    {
        $this->assertEquals('the-email', $this->user->getEmail());
    }

    public function testSetEmailWorks()
    {
        $this->user->setEmail('another-email');

        $this->assertEquals('another-email', $this->user->getEmail());
    }

    public function testGetRealNameWorks()
    {
        $this->assertEquals('the-realname', $this->user->getRealName());
    }

    public function testGetScreenNameWorksWhenNoScreenNameWasSet()
    {
        $this->assertEquals('the-realname', $this->user->getScreenName());
    }

    public function testGetScreenNameWorksWhenAScreenNameWasSet()
    {
        $this->user->setScreenName('the-screenname');

        $this->assertEquals('the-screenname', $this->user->getScreenName());
    }

    public function testDeleteScreenNameWorks()
    {
        $this->user->setScreenName('the-screenname');
        $this->user->deleteScreenName();

        $this->assertEquals('the-realname', $this->user->getScreenName());
    }

    public function testConstructorSetsScreennameWhenGiven()
    {
        $user = new User(1, 'the-email', 'the-realname', 'the-screenname');

        $this->assertEquals('the-screenname', $user->getScreenName());
    }
}