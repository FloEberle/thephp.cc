<?php

class Game
{
    private $configuration;
    private $players = array();
    private $cards = array();
    private $factory;
    private $gameInProgress = false;
    private $logger;

    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function initialize(Factory $factory)
    {
        $this->factory = $factory;
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

            //Give him n - 1 cards
            shuffle($this->cards);
            $numberOfCards = count($this->cards);
            for ($i = 0; $i < $numberOfCards; $i++) {
                $player->addCard($this->cards[$i]);
            }

            $this->players[] = $player;
        }

        //Shuffle Players
        shuffle($this->players);

        $this->gameInProgress = true;
    }

    public function play()
    {
        while ($this->gameInProgress) {
            foreach ($this->players as $player) {
                $player->makeMove();
                if (!$this->gameInProgress) {
                    $this->logger->log('Player '.$player->getName().' has won the game');
                    break;
                }
            }
        }

    }

    public function stopGame()
    {
        $this->gameInProgress = false;
    }
}
