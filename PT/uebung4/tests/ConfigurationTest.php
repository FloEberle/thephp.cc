<?php

class ConfigurationTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->configuration = new Configuration();
    }

    public function returnDummyConfigurationIni()
    {
        return array('colors' => array('red', 'yellow', 'blue', 'green', 'brown', 'violet'),
            'players' => array('Bob', 'Alice', 'Carol'));
    }


    public function testReadIniFileWorks()
    {
        $this->assertEquals($this->returnDummyConfigurationIni(), $this->configuration->readIniFile());
    }

}
