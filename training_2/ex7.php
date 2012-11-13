<?php

interface Executable
{
    public function execute();
}

abstract class AbstractBaseClass implements Executable
{
    final public function execute()
    {
        $result = $this->doWork();
        if ($result) {
            $this->displayResult();
        } else {
            $this->displayError();
        }
    }
    
    abstract protected function doWork();
    abstract protected function displayResult();
    abstract protected function displayError();
}

class ConcreteClass extends AbstractBaseClass
{
    protected function doWork()
    {
        var_dump('doing work');
        
        return (bool) rand(0, 1);
    }

    protected function displayResult()
    {
        var_dump('result');
    }

    protected function displayError()
    {
        var_dump('error');
    }
}

$class = new ConcreteClass();
$class->execute();
