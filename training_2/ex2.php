<?php

$foo = new Foo();
$foo->run();

var_dump($foo);

class Foo
{
    private $foo;

    public function run()
    {
        unset($this->foo);
    
        $this->foo = 23;
        var_dump($this->foo);
        $this->bar = 42;
        var_dump($this->bar);
    }
}
