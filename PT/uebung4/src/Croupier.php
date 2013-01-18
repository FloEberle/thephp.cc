<?php

class Croupier
{
    private $gameColors = array();
    private $players = array();

    public function __construct($gameColors, $players)
    {
        $this->gameColors = $gameColors;
        $this->players = $players;
    }

    /**
     * every player receives 1 card of each color, less a randomly selected one
     */
    public function dealCards()
    {
        foreach ($this->players as $player){
            $player->receiveCards($this->createPlayerCards());
        }
    }

    /**
     * @return array
     */
    private function createPlayerCards()
    {
        $playerCards = array();
        $random = rand(0, count($this->gameColors) - 1);
        foreach ($this->gameColors as $color){
            $playerCards[] = new Card($color);
        }
        unset($playerCards[$random]);
        return $playerCards;
    }
}
