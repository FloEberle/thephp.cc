<?php

class PlayerCollection
{
    /**
     * @var array
     */
    private $players = array();

    /**
     * @param Player $player
     */
    public function addPlayer(Player $player)
    {
        $this->players[] = $player;
    }

    /**
     * @return array
     */
    public function getPlayers()
    {
        return $this->players;
    }
}