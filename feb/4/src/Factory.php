<?php

class Factory
{
    private $configuration;
    private $game;
    private $logger;

    /**
     * @param Configuration $configuration
     */
    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * @param $type string
     *
     * @return Configuration|Dice|Game|Player|StdoutLogger
     * @throws Exception
     */
    public function getInstanceFor($type)
    {
        switch ($type) {
            case 'Config':
                return $this->configuration;
                break;
            case 'Game':
                //We only want one instance of game
                if ($this->game === null) {
                    $this->game = new Game($this->configuration);
                }
                return $this->game;
                break;
            case 'Player':
                return new Player(
                    $this->configuration,
                    $this->getInstanceFor('Game'),
                    $this->getInstanceFor('StdoutLogger'),
                    $this->getInstanceFor('Dice'));
                break;

            case 'StdoutLogger':
                if ($this->logger === null) {
                    $this->logger = new StdoutLogger();
                }
                return $this->logger;

            case 'Dice':
                return new Dice($this->configuration, $this->getInstanceFor('StdoutLogger'));
            default:
                throw new Exception('Factory kennt Klasse "' . $type . '" nicht!');
        }
    }
}
