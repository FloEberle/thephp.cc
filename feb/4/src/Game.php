<?php

class Game implements GameInterface
{
    /**
     * @var ConfigurationInterface
     */
    private $configuration;

    /**
     * @var array
     */
    private $players = array();

    /**
     * @var array
     */
    private $cards = array();

    /**
     * @var Factory
     */
    private $factory;

    /**
     * @var bool
     */
    private $gameInProgress = false;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param ConfigurationInterface $configuration
     */
    public function __construct(ConfigurationInterface $configuration, Factory $factory)
    {
        $this->configuration = $configuration;
        $this->factory = $factory;
    }

    /**
     * @param Factory $factory
     */
    public function initialize()
    {
        $this->logger = $this->factory->getInstanceFor('StdoutLogger');
        $config = $this->factory->getInstanceFor('Config');

        //Initialize Cards
        foreach ($config->get('colors') as $color) {
            $this->cards[] = new Card($color);
        }

        //Initialize Players
        foreach ($config->get('players') as $playername) {
            $player = $this->factory->getInstanceFor('Player');
            $player->setName($playername);

            //Give the player n - 1 cards
            shuffle($this->cards);
            $numberOfCards = count($this->cards);
            for ($i = 0; $i < $numberOfCards; $i++) {
                $player->addCard($this->cards[$i]);
            }

            $this->players[] = $player;
        }

        shuffle($this->players);
        $this->gameInProgress = true;
        $this->logger->log('Game initialized!');

        foreach ($this->players as $player) {
            $this->logger->log($player);
        }


    }

    public function play()
    {
        if (!$this->gameInProgress) {
            throw new LogicException('Game must be initialized before playing!');
        }
        $this->logger->log("Let the hunger games begin\n=============================================");
        while ($this->gameInProgress) {
            foreach ($this->players as $player) {
                $player->makeMove();
                if (!$this->gameInProgress) {
                    $this->logger->log('Player "' . $player->getName() . '" has won the game');
                    break;
                }
            }
        }
        foreach ($this->players as $player) {
            $this->logger->log($player);
        }
    }

    public function stopGame()
    {
        $this->gameInProgress = false;
    }
}
