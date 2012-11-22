<?php

/**
 * @covers Dice
 */
class DiceTest extends AbstractTest
{
    private $color;
    protected function setUp()
    {
        parent::setUp();
        $this->color = 'GREEN';
    }

    public function testGetRandomColorOutOfOnlyOne()
    {
        $this->configurationMock->expects($this->once())->method('get')->will($this->returnValue(array($this->color)));
        $this->dice = new Dice($this->configurationMock, $this->loggerMock);
        $this->assertSame($this->color, $this->dice->getRandomColor());
    }
}