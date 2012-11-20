<?php
class TestClass
{
    private $foo;
    private $bar = array();

    public function __construct($foo)
    {
        $this->foo = $foo;
    }

    public function save(TestClass $class)
    {
        $this->bar = $class;
    }
    public function __toString()
    {
        return 'Test  ' . date('d.m.Y') . PHP_EOL ;
    }
    public function setFoo($value)
    {
        $this->foo = $value;
    }
}

$class1 = new TestClass('Hallo');
/*echo $class;*/

var_dump($class1);

$class2 = new TestClass('Klasse 2');
$class2->save($class1);

var_dump($class2);

$class1->setFoo('neuer Wert für Klasse 1');

var_dump($class2);