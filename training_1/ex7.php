<?php

$customer = new Customer('23-421324', 'Hugo');

var_dump($customer->getId());
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
