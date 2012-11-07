<?php

class Customer
{
    public function getName()
    {
        return $this->firstname . ' ' . $this->lastname;
    }
}
