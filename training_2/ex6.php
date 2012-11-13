<?php

interface CustomerDiscountCriterionInterface
{
    public function isSatisfiedBy(Customer $customer);
    public function getDiscount();
}

abstract class Criterion implements CustomerDiscountCriterionInterface
{
    /**
     * @returns bool
     */
    public function isSatisfiedBy(Customer $customer)
    {
    }
    
    /**
     * @returns int
     */
    public function getDiscount()
    {
    }
}

class BuddyCriterion extends Criterion
{
    public function isSatisfiedBy(Customer $customer)
    {
        return $customer->getBuddyStatus();
    }
    
    public function getDiscount()
    {
        return 5;
    }
}

class ERP
{
    public function getTotalRevenue($customerId)
    {
        return rand(20000, 250000);
    }
}

class RevenueCriterion extends Criterion
{
    private $erp;

    public function __construct(ERP $erp)
    {
        $this->erp = $erp;
    }

    public function isSatisfiedBy(Customer $customer)
    {
        return $this->erp->getTotalRevenue($customer->getId()) > 100000;
    }
    
    public function getDiscount()
    {
        return 10;
    }
}

class Customer
{
    private $criteria = array();

    public function addCriterion(CustomerDiscountCriterionInterface $criterion)
    {
        $this->criteria[] = $criterion;
    }
    
    public function getId()
    {
        return 42;
    } 
        
    public function getBuddyStatus()
    {
        return (bool) rand(0, 1);
    }

    /**
     * @returns int Discount in percent
     */
    public function getDiscount()
    {
        $maxDiscount = 0;
    
        foreach ($this->criteria as $criterion) {
            if ($criterion->isSatisfiedBy($this)) {
                $discount = $criterion->getDiscount();
                if ($discount > $maxDiscount) {
                    $maxDiscount = $discount;
                }
            }
        }

        return $maxDiscount; 
    }
}

$erp = new ERP();

$johnDoe = new Customer();

$johnDoe->addCriterion(new BuddyCriterion());
$johnDoe->addCriterion(new RevenueCriterion($erp));

// $johnDoe->addCriterion(new Criterion());

var_dump($johnDoe->getDiscount());
