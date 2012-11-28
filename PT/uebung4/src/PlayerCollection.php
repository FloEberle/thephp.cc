<?php

class PlayerCollection
{
    private $playerlist = array();

    public function __construct(Configuration $configurationBackend)
    {
        $ini = $configurationBackend->readIniFile();
        $this->playerlist['names'] = $ini['players'];
    }

    public function add(Player $player)
    {
        $this->playerlist['players'][] = $player;
    }

    /**
     * @return array
     */
    public function getPlayerNames()
    {
        return $this->playerlist['names'];
    }

    /**
     * @return array
     */
    public function getPlayers()
    {
        return $this->playerlist['players'];
    }
}
