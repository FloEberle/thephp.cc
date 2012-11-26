<?php

class PlayerCollection
{
    private $players = array();

    public function push(Player $player)
    {
        $this->players[] = $player;
    }

    public function getAllPlayers()
    {
        return $this->players;
    }
}
