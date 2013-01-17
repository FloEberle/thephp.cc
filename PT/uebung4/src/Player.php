<?php

class Player
{
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
        $this->cards[] = $cards;
    }

    /**
     * @param $color
     * @return bool
     */
    public function hasCard($color)
    {
        foreach ($this->cards as $card){
            if ($color == $card->getColor()){
                $this->turnCard($card);
            }
        }
    }

    /**
     * @return bool
     */
    public function hasCardsLeft()
    {
        return count($this->cards) > 0;
    }

    /**
     * @param $card
     */
    private function turnCard(Card $card)
    {
        $card->turn();
    }
}
