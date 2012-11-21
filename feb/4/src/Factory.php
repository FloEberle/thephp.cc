<?php

class Factory
{
    private $configuration;
    private $game;

    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function getInstanceFor($type)
    {
        switch ($type) {
            case 'Config':
                return $this->configuration;
                break;
            case 'Game':
                //We only want one instance of game
                if ($this->game === null) {
                    $this->game = new Game($this->configuration);
                }
                return $this->game;
                break;
            case 'Player':
                return new Player($this->configuration, $this->getInstanceFor('Game'), $this->getInstanceFor('StdoutLogger'));
            break;

            case 'StdoutLogger':
                return new StdoutLogger();
            default:
                throw new Exception('Factory kennt Klasse "'.$type.'" nicht!');
        }
    }
}
