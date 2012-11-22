<?php

abstract class AbstractTest extends PHPUnit_Framework_TestCase
{
    protected $loggerStub;
    protected $diceStub;
    protected $configurationStub;
    protected $gameStub;

    protected function setUp()
    {
        $this->loggerStub = $this->getMock('LoggerInterface');
        $this->diceStub = $this->getMock('DiceInterface');
        $this->configurationStub = $this->getMock('ConfigurationInterface');
        $this->gameStub = $this->getMock('GameInterface');
    }
}
