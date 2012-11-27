<?php

class CubeTest extends PHPUnit_Framework_TestCase
{
    /**
     *
     * @var array
     */
    private $colors = array('blue', 'green', 'yellow');
    
    public function testCubeRandomColor()
    {
        $cube = new Cube($this->colors);
        $this->assertNotNull($cube->getRandomColor());
        $this->assertInternalType('string', $cube->getRandomColor());
    }
}