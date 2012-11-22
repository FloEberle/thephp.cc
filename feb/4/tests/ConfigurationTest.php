<?php
class ConfigurationTest extends PHPUnit_Framework_TestCase
{
    private $file;
    private $configuration;
    private $key;
    private $value;

    protected function setUp()
    {
        $this->file = __DIR__.'/testsettings.ini';
        $this->key = 'test';
        $this->value = 'value';
        if (!file_exists($this->file)) {
            $handle = fopen($this->file, 'w');
            fwrite($handle, $this->key.' = '.$this->value);
        }
        $this->configuration = new Configuration($this->file);
    }

    public function testGetExistingKey()
    {
        $this->assertSame($this->configuration->get($this->key), $this->value);
    }

    public function testGetExistingKeyTwice()
    {
        $this->assertSame($this->configuration->get($this->key), $this->value);
        $this->assertSame($this->configuration->get($this->key), $this->value);
    }

    /**
     * @expectedException Exception
     */
    public function testGetNonExistingKeY()
    {
        $this->configuration->get('I_DONT_EXIST');
    }

    /**
     * @expectedException Exception
     */
    public function testGetInstanceOfNonExistingFileLazyLoaded()
    {
        $this->configuration = new Configuration('I_DONT_EXIST');
        $this->configuration->get($this->key);
    }

    protected function tearDown()
    {
        if (file_exists($this->file)) {
            unlink($this->file);
        }
    }
}