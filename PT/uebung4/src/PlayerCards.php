<?php

class PlayerCards
{
    private $colors = array();

    public function __construct(GameColors $gameColors)
    {
        $this->colors = $gameColors->getAllColors();
    }

    public function createPlayerCards($numberOfCards)
    {
        $cards = $this->colors;
        $random = rand(1, $numberOfCards);
        unset($cards[$random]);
        return $cards;
    }
}
