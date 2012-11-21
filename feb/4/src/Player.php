<?php

class Player
{
    private $configuration;
    private $name;
    private $cards;
    private $game;
    private $logger;

    public function __construct(Configuration $configuration, Game $game, LoggerInterface $logger)
    {
        $this->configuration = $configuration;
        $this->logger = $logger;
        $this->game = $game;
        $this->cards = new SplObjectStorage();
    }

    public function makeMove()
    {
        $this->logger->log($this->name . ' made a move!');
        if (rand(0, 6) == 1) {
            $this->game->stopGame();
        }
    }


    public function rollTheDice()
    {

    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function addCard(Card $card)
    {
        $this->cards->attach($card);
    }
}
