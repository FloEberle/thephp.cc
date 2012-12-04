<?php

class User
{
	private $userId;
	private $userRealName;
	private $userMailAddress;
	private $userScreenName;

	public function __construct($userId, $userRealName, $userMailAddress, $userScreenName = null)
	{
		$this->userId = $userId;
		$this->setRealName($userRealName);
		$this->userMailAddress = $userMailAddress;

		$this->setUserScreenName($userScreenName);

        if ($this->userId == null) {
            throw new InvalidArgumentException('no userId found');
        }

		if ($this->userMailAddress == null){
			throw new InvalidArgumentException('userMailAddress string is empty');
		}
	}

    private function setRealName($realName)
    {
        if ($realName == null){
            throw new InvalidArgumentException('RealName is empty');
        }

        $this->userRealName = $realName;
    }

	public function getUserRealName()
	{
		return $this->userRealName;
	}

	public function getUserMailAddress()
	{
		return $this->userMailAddress;
	}

	public function hasUserScreenName()
	{
		return isset($this->userScreenName);
	}

	public function getUserScreenName()
	{
		return $this->userScreenName;
	}

    public function setUserScreenName($userScreenName)
    {
        if ($userScreenName == null) {
            $this->userScreenName = $this->userRealName;
        }
    }
}
