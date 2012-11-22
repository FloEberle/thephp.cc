<?php
class Dice implements DiceInterface
{
    private $colors = array();

    public function __construct(Configuration $configuration, LoggerInterface $logger)
    {
        $this->colors = $configuration->get('colors');
        $this->logger = $logger;
    }

    public function getRandomColor()
    {
        $size = count($this->colors) - 1;
        $random = mt_rand(0, $size);
        $this->logger->log('The dice shows the color "' . $this->colors[$random] . '"');
        return $this->colors[$random];
    }
}
