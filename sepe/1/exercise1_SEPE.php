<?php

/**
 * Uebungsaufgabe 1
 *
 */

$customer1 = new User(1, 'customer1@exercise1.ch','Benutzer Eins');
$customer2 = new User(2, 'customer2@exercise1.ch','Benutzer Zwei', 'usr2');

var_dump($customer1);
var_dump($customer2);

class User
{
	private $id;
	private $realName;
	private $email;
	private $screenName;

	public function __construct($id, $email, $realName, $screenName = null)
	{
		$this->id = $id; // oder muss Setter geschrieben werden?
		$this->setEmail($email); // oder per $this->email = $email;?
		$this->realName = $realName; // oder muss Setter geschrieben werden?

		if ($screenName !== null) {
			$this->setScreenName($screenName);
        }
	}

    /**
     * @return string
     */
	public function getID()
	{
		return $this->id;
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
		$this->email=$email;
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

    // Lösungsvorschlag Teilaufgabe c
    public function deleteScreenName()
    {
        $this->screenName = null;
    }
}
