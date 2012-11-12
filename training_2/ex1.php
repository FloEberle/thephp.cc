<?php

$foo = new foo();
var_dump($foo->Run());

class FOO
{
    private $foo;

    public function run()
    {
        var_dump($this->foo);
    }
}
