<?php

class User
{
	/**
	 *	@var string	$realName
 	 */
	private $realName;

    /**
     * @var string $mail
     */
    private $mail;

    /**
     * @var string $screenName
     */
    private $screenName;

    /**
     * @var string $id
     */
    private $id;

	/*
		@param string $realName
		@param string $mail
		@param string $
	*/
	public function __construct ($id, $realName, $mail, $screenName = null)
	{
		$this->realName = $realName;
		$this->id = $id;
		$this->setMail($mail);

        if ($screenName !== null) {
            $this->setScreenName($screenName);
        }
	}

	/*
		@param string $mail
	*/
	public function setMail($mail)
	{
		$this->mail = $mail;
	}

	/*
		@param string $screenName
	*/
	public function setScreenName($screenName)
    {
        if ($screenName == '') {
            throw new RuntimeException('...');
        }

		$this->screenName = $screenName;
	}

    public function deleteScreenName()
    {
        $this->screenName = null;
    }

	/*
		@return string $realName
	*/
	public function getRealName()
	{
		return $this->realName;
	}

	/*
		@return string $mail
	*/
	public function getMail()
	{
		return $this->mail;
	}

	/*
		@return string $screenName
	*/
	public function getScreenName()
	{
         if ($this->screenName == null) {
             return $this->realName;
         }

         return $this->screenName;
	}

	/*
		@return int $id
	*/
	public function getId()
	{
		return $this->id;
	}
}