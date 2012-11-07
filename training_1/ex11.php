<?php

$customer = new Customer();

$order = new Order();
$order->addItem(new OrderItem(1));

$customer->addOrder($order);

$order = new DiscountedOrder();
$order->addItem(new OrderItem(1));
$order->addItem(new OrderItem(2));

$customer->addOrder($order);

$order = new Order();
$order->addItem(new OrderItem(1));
$order->addItem(new OrderItem(2));
$order->addItem(new OrderItem(3));

$customer->addOrder($order);

var_dump($customer->getOrderTotal());
var_dump($customer);

class Customer
{
    private $orders = array();

    /**
     * @param Order $order
     */
    public function addOrder(Order $order)
    {
        $this->orders[] = $order;
    }

    public function getOrderTotal()
    {
        $total = 0;
        
        foreach ($this->orders as $order) {
            $total += $order->getTotal();
        }
        
        return $total;
    }
}

class Order
{
    private $items = array();
    
    public function addItem(OrderItem $item)
    {
        $this->items[] = $item;
    }

    public function getTotal()
    {
        $total = 0;
    
        foreach ($this->items as $item) {
            $total += $item->getPrice();
        }
        
        return $total;
    }
}


class DiscountedOrder extends Order
{
    private $rebate = 0.05;

    public function getTotal()
    {
        return parent::getTotal() * (1 - $this->rebate);
    }
}


class OrderItem
{
    private $price;
    
    public function __construct($price)
    {
        $this->price = $price;
    }

    public function getPrice()
    {
        return $this->price;
    }
}

class Cow
{
}
