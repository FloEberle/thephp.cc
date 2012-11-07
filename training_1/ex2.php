<?php

int $a = 42;

foo((string) $a);

/**
 * @param string $foo
 */
function foo(string $foo)
{
    var_dump($foo);
}
