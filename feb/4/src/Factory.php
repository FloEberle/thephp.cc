<?php

class Factory
{
    private $configuration;
    private $game;
    private $logger;

    /**
     * @param ConfigurationInterface $configuration
     */
    public function __construct(ConfigurationInterface $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * @param $type string
     *
     * @return ConfigurationInterface|DiceInterface|GameInterface|Player|LoggerInterface|CroupierInterface
     * @throws Exception
     */
    public function getInstanceFor($type)
    {
        switch ($type) {
            case 'Config':
                return $this->configuration;
            case 'Game':
                //We only want one instance of game
                if ($this->game === null) {
                    $this->game = new Game($this->configuration, $this, $this->getInstanceFor('Croupier'));
                }
                return $this->game;
            case 'Player':
                return new Player(
                    $this->configuration,
                    $this->getInstanceFor('Game'),
                    $this->getInstanceFor('Logger'),
                    $this->getInstanceFor('Dice'));

            case 'Logger':
                if ($this->logger === null) {
                    $this->logger = new StdoutLogger();
                }
                return $this->logger;

            case 'Dice':
                return new Dice($this->configuration, $this->getInstanceFor('Logger'));
            case 'Croupier':
                return new Croupier();
            default:
                throw new Exception('Factory kennt Klasse "' . $type . '" nicht!');
        }
    }
}
