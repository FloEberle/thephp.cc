<?php

class PlayerCollection
{
    private $playerlist = array();
    private $playernames = array();

    public function add(Player $player)
    {
        $this->playerlist[] = $player;
    }

    /**
     * @return array
     */
    public function getPlayerNames()
    {
        foreach($this->playerlist as $player){
            $this->playernames[] = $player->getName();
        }
        return $this->playernames;
    }

    /**
     * @return array
     */
    public function getPlayers()
    {
        return $this->playerlist;
    }
}
