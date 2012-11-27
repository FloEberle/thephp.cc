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
     * @var CroupierInterface
     */
    private $croupier;

    /**
     * @var Player
     */
    private $winner;

    /**
     * @param ConfigurationInterface $configuration
     * @param Factory                $factory
     * @param CroupierInterface      $croupier
     */
    public function __construct(ConfigurationInterface $configuration, Factory $factory, CroupierInterface $croupier)
    {
        $this->configuration = $configuration;
        $this->factory = $factory;
        $this->croupier = $croupier;
    }

    public function initialize()
    {
        $this->logger = $this->factory->getInstanceFor('Logger');

        //Initialize Cards
        foreach ($this->configuration->get('colors') as $color) {
            $this->cards[] = new Card($color);
        }

        //Initialize Players
        foreach ($this->configuration->get('players') as $playername) {
            $player = $this->factory->getInstanceFor('Player');
            $player->setName($playername);


            //Give the player n - 1 random cards
            $numberOfCards = count($this->cards);
            $this->cards = $this->croupier->shuffle($this->cards);
            for ($i = 0; $i < $numberOfCards; $i++) {
                $player->addCard($this->cards[$i]);
            }

            $this->players[] = $player;
        }

        $this->players = $this->croupier->shuffle($this->players);
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
                    $this->winner = $player;
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

    public function getWinner()
    {
        return $this->winner;
    }
}
