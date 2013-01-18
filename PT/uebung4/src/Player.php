<?php

class Player
{
    /**
     * @var array
     */
    private $cards = array();

    /**
     * @var string
     */
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $cards
     */
    public function receiveCards($cards)
    {
        $this->cards = $cards;
    }

    /**
     * @param $color
     */
    public function hasCard($color)
    {
        foreach ($this->cards as $card) {
            if ($card->getColor() == $color) {
                $this->turnCard($card);
            }
        }
    }

    /**
     * @return bool
     */
    public function hasCardsLeft()
    {
        foreach ($this->cards as $card) {
            if ($card->isTurned() == false) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param Dice $dice
     * @return string $color
     */
    public function throwDice(Dice $dice)
    {
        return $dice->roll();
    }

    /**
     * @param Card $card
     */
    private function turnCard(Card $card)
    {
        $card->turn();
    }
}
