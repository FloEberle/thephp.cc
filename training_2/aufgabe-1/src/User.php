<?php

class User
{
	private $id;
	private $realName;
	private $email;
	private $screenName;

	public function __construct($id, $email, $realName, $screenName = null)
	{
		$this->id = $id;
		$this->setEmail($email);
		$this->realName = $realName;

		if ($screenName !== null) {
			$this->setScreenName($screenName);
        }
	}

    /**
     * @return string
     */
	public function getRealName()
	{
		return $this->realName;
	}

    /**
     * @param string $email
     */
	public function setEmail($email)
	{
        if (strpos($email, '@') === false) {
            throw new InvalidArgumentException('Invalid email');
        }

		$this->email = $email;
	}

    /**
     * @return string
     */
	public function getEmail()
	{
		return $this->email;
	}

    /**
     * @param string $screenName
     */
	public function setScreenName($screenName)
	{
		$this->screenName=$screenName;
	}

    /**
     * @return string
     */
	public function getScreenName()
	{
        if ($this->screenName === null) {
            return $this->getRealName();
        }

        return $this->screenName;
	}

    public function deleteScreenName()
    {
        $this->screenName = null;
    }
}