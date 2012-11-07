<?php

$customer = new LoggingCustomer(23, 'Hugo');
$customer->setName(42);

var_dump($customer);

class Customer
{
    /**
     * @var int
     */
    private $id = null;
    private $name = null;

    public function __construct($id, $name = null)
    {
        $this->setId($id);
        
        if ($name !== null) {
            $this->setName($name);
        }
    }
        
    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        if (!is_string($name)) {
            throw new InvalidArgumentException('...');
        }
    
        $this->name = $name;
    }
    
    public function getName()
    {
        return $this->name;
    }

    private function setId($id)
    {
        if (!is_int($id)) {
            throw new InvalidArgumentException('...');
        }

        $this->id = $id;
    }
}

class LoggingCustomer extends Customer
{
    public function setName($name)
    {
        parent::setName($name);
        
        var_dump('Neuer Name: ' . $name);
    }
}
