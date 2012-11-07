<?php

$bar = new Bar();
$bar->incrementA();
var_dump($bar);

class Foo
{
    /**
     * @var int
     */
    private $b = 0;
    
    protected function setA($a)
    {
        $this->b = $a;
    }
    
    protected function getA()
    {
        return $this->b;
    }
}

class Bar extends Foo
{
    public function incrementA()
    {
        $this->setA($this->getA() + 1);
    }
}
