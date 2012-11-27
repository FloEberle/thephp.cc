<?php

class PlayerCards
{
    private $colors = array();

    public function __construct(GameColors $gameColors)
    {
        $this->colors = $gameColors->getAllColors();
    }

    /**
     * @return array
     */
    public function createPlayerCards()
    {
        $cards = $this->colors;
        $random = rand(0, count($this->colors) - 1);
        unset($cards[$random]);
        return $cards;
    }
}
