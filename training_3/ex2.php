<?php

$data = array();

class Foo
{
}

$store = new SplObjectStorage();

$foo = new Foo();
$foo->bar = 42;
$data[] = $foo;
$store->attach($foo);

$foo = new Foo();
$foo->bar = 23;
$data[] = $foo;
$store->attach($foo);

var_dump(serialize($data));
var_dump(serialize($store));

$bar = new Foo();

var_dump($store->contains($foo));
var_dump($store->contains($bar));
