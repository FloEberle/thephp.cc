<?php

$object = new Foo();
$object->foo();

class Foo
{
    private $data = array(1, 2, 3, 4, 5); // viele, viele Daten

    public function foo()
    {
        ... $this->data ...
    }
}
