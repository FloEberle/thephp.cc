<?php

/*
 * @-covers Cube
 */
class CubeTest extends PHPUnit_Framework_TestCase
{
    private $cube;

    public function setUp()
    {
        $this->configuration = new Configuration();
        $this->gameColors = new GameColors($this->configuration);
        $this->cube = new Cube($this->gameColors);
    }

    public function testNewCubeIsInstanceOfCube()
    {
        $this->assertInstanceOf('Cube', new Cube($this->gameColors));
    }

    public function testCubeRollReturnsColorWorks()
    {
        $color = $this->cube->roll();
        $this->assertTrue(in_array($color, $this->cube->getAllColors()));
    }

    public function testCubeGetAllColorsWorks()
    {
        $configuration = new Configuration();
        $ini = $configuration->readIniFile();
        $this->assertEquals($ini['colors'], $this->cube->getAllColors());
    }
}
