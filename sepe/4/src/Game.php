<?php

class Game
{

    /**
     * @var array
     */
    private $players = array();


    public function __construct()
    {

    }

    /**
     * @param Player $player
     */
    public function addPlayer(Player $player)
    {
        $this->players[] = $player;
    }

}