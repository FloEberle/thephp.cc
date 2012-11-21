<?php

class TestCube extends PHPUnit_Framework_TestCase
{
    private $cube;

    public function setUp()
    {
        $this->cube = new Cube;
    }

    public function testCubeRollReturnsColor()
    {
        assertArrayHasKey($this->cube->roll(), $this->cube->getColors());
    }
}
