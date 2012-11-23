<?php

/*
 * @covers Cube
 */
class CubeTest extends PHPUnit_Framework_TestCase
{
    private $cube;

    public function setUp()
    {
        $this->colorBackend = new ColorBackend();
        $this->gameColors = new GameColors($this->colorBackend);
        $this->cube = new Cube($this->gameColors);
    }

    public function testCubeRollReturnsColor()
    {
        $color = $this->cube->roll();
        $this->assertTrue(in_array($color, $this->cube->getAllColors));
    }
}
