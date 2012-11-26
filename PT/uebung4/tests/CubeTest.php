<?php

/*
 * @covers Cube
 */
class CubeTest extends PHPUnit_Framework_TestCase
{
    private $cube;

    public function setUp(ColorBackend $colorBackend, GameColors $gameColors, Cube $cube)
    {
        $colorBackend = new ColorBackend();
        $gameColors = new GameColors($colorBackend);
        $this->cube = new Cube($this->gameColors);
    }

    public function testNewCubeIsInstanceOfCube()
    {
        $this->assertInstanceOf(new Cube(), $this->cube);
    }

    public function testCubeRollReturnsColorWorks()
    {
        $color = $this->cube->roll();
        $this->assertTrue(in_array($color, $this->cube->getAllColors));
    }
}
