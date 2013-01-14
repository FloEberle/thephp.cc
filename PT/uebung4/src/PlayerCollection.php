<?php

class PlayerCollection
{
    private $playerList = array();
    private $playerNames = array();

    public function add(Player $player)
    {
        $this->playerList[] = $player;
    }

    /**
     * @return array
     */
    public function getPlayerNames()
    {
        foreach($this->playerList as $player){
            $this->playerNames[] = $player->getName();
        }
        return $this->playerNames;
    }

    /**
     * @return array
     */
    public function getPlayers()
    {
        return $this->playerList;
    }
}
