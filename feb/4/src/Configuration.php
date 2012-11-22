<?php
class Configuration implements ConfigurationInterface
{
    /**
     * @var String
     */
    private $file;

    /**
     * @var array
     */
    private $settings = array();

    /**
     * @var bool
     */
    private $isLoaded = false;

    /**
     * @param $file string
     */
    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * @param $key string
     *
     * @return string
     * @throws Exception
     */
    public function get($key)
    {
        $this->load();
        if (!isset($this->settings[$key])) {
            throw new Exception('Configuration setting "' . $key . '" does not exist');
        }
        return $this->settings[$key];
    }

    private function load()
    {
        if ($this->isLoaded) {
            return;
        }

        if (!is_readable($this->file)) {
            throw new Exception('Cannot read configuration file "' . $this->file . '"');
        }

        $this->settings = parse_ini_file($this->file);
        $this->isLoaded = true;
    }

}
