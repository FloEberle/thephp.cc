<?php
class FactoryTest extends AbstractTest
{
    private $factory;
    private $configurationTest;
    protected function setUp()
    {
        parent::setUp();
        //Too hard to mock, using testconfiguration.
        $this->configurationTest = new Configuration(__DIR__ . '/../config/settings_test.ini');
        $this->factory = new Factory($this->configurationTest);
    }

    public function testGetInstanceOfConfigWorks()
    {
        $this->assertSame($this->factory->getInstanceFor('Config'), $this->configurationTest);
    }

    public function testGetInstanceOfGameWorks()
    {
        $this->assertTrue($this->factory->getInstanceFor('Game') instanceof Game);
    }

    public function testGetInstanceOfPlayerWorks()
    {
        $this->assertTrue($this->factory->getInstanceFor('Player') instanceof Player);
    }

    public function testGetInstanceOfLoggerWorks()
    {
        $this->assertTrue($this->factory->getInstanceFor('StdoutLogger') instanceof LoggerInterface);
    }

    public function testGetInstanceOfDiceWorks()
    {
        $this->assertTrue($this->factory->getInstanceFor('Dice') instanceof Dice);
    }

    /**
     * @expectedException Exception
     */
    public function testGetInstanceForWithInvalidClass()
    {
        $this->factory->getInstanceFor('IamNotExisting');
    }
}



