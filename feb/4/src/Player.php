<?php

class Player
{
    private $configuration;
    private $name;
    private $dice;
    private $cards;
    private $game;
    private $logger;

    public function __construct(Configuration $configuration, Game $game, LoggerInterface $logger, DiceInterface $dice)
    {
        $this->configuration = $configuration;
        $this->logger = $logger;
        $this->game = $game;
        $this->dice = $dice;
    }

    public function makeMove()
    {
        $this->logger->log('"'.$this->name . '" started a move!');
        $randomColor = $this->dice->getRandomColor();
        foreach ($this->cards as $position => $card) {
            if ($card->getColor() === $randomColor) {
                $this->logger->log($this->name . ' removed the "' . $randomColor . '" card from the deck');
                unset($this->cards[$position]);
            }
        }
        if (count($this->cards) === 0) {
            $this->game->stopGame();
        }
        $this->logger->log('"'.$this->name . '" ended a move!');
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
        $this->cards[] = $card;
    }

    public function __toString()
    {
        $str = 'Player "' . $this->getName() . '" current Cards: ';
        foreach ($this->cards as $card) {
            $str .= '"'.$card->getColor() . '" ';
        }
        return $str;
    }
}
