<?php
/**
 * Benutzer Entitaet gemaess Aufgabenstellung
 */
class User
{
    /**
     * @var int
     */
    private $id;
    
    /**
     * @var string
     */
    private $realName;
    
    /**
     * @var string
     */
    private $screenName;
    
    /**
     * @var string
     */
    private $email;
    
    /**
     * @param int $id
     * @param string $realName
     * @param string $email
     */
    public function __construct($id, $realName, $email)
    {
        $this->id = $id;
        $this->realName = $realName;
        $this->email = $email;
    }

    /**
     * @param string $screenName
     */
    public function setScreenName($screenName)
    {
        $this->screenName = $screenName;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * @return string;
     */
    public function getRealName()
    {
        return $this->realName;
    }
    
    /**
     * 
     * @return string;
     */
    public function getScreenName()
    {
        if($this->screenName == null)
        {
            return $this->realName;
        }
        return $this->screenName;
    }    
}

