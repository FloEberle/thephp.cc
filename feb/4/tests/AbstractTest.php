<?php

abstract class AbstractTest extends PHPUnit_Framework_TestCase
{
    protected $loggerMock;
    protected $diceMock;
    protected $configurationMock;
    protected $gameMock;

    protected function setUp()
    {
        $this->loggerMock = $this->getMock('LoggerInterface');
        $this->diceMock = $this->getMock('DiceInterface');
        $this->configurationMock = $this->getMock('ConfigurationInterface');
        $this->gameMock = $this->getMock('GameInterface');
    }
}
