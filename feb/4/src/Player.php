<?php

class Player
{
    private $configuration;
    private $name;
    private $dice;
    private $cards;
    private $game;
    private $logger;

    /**
     * @param ConfigurationInterface   $configuration
     * @param GameInterface            $game
     * @param LoggerInterface $logger
     * @param DiceInterface   $dice
     */
    public function __construct(ConfigurationInterface $configuration, GameInterface $game, LoggerInterface $logger, DiceInterface $dice)
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

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name string
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param Card $card
     */
    public function addCard(Card $card)
    {
        $this->cards[] = $card;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $str = 'Player "' . $this->getName() . '" current Cards: ';
        foreach ($this->cards as $card) {
            $str .= '"'.$card->getColor() . '" ';
        }
        return $str;
    }
}
