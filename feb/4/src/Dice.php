<?php
class Dice implements DiceInterface
{
    /**
     * @var array
     */
    private $colors = array();

    /**
     * @param Configuration   $configuration
     * @param LoggerInterface $logger
     */
    public function __construct(Configuration $configuration, LoggerInterface $logger)
    {
        $this->colors = $configuration->get('colors');
        $this->logger = $logger;
    }

    /**
     * @return string
     */
    public function getRandomColor()
    {
        $size = count($this->colors) - 1;
        $random = mt_rand(0, $size);
        $this->logger->log('The dice shows the color "' . $this->colors[$random] . '"');
        return $this->colors[$random];
    }
}
