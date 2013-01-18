<?php

/*
 * Das ist der Spielablauf, der imho nicht getestet werden muss,
 * da alle Komponenten des Spiels einzeln getestet werden
 */
class Game
{
    // @codeCoverageIgnoreStart
    private $gameIsPrepared = false;
    private $gameIsFinished = false;

    private $gameColors = array();
    private $players = array();

    private $croupier;

    public function __construct(Configuration $configuration,
                                Cube $cube)
    {
        $this->configuration = $configuration;
        $this->playerNames = $this->configuration->getPlayers();
        $this->gameColors= $this->configuration->getColors();
        $this->cube = $cube;

    }

    private function prepare()
    {
        foreach ($this->playerNames as $name){
            $this->players[] = new Player($name);
        }
        $this->croupier = new Croupier($this->gameColors, $this->players);
        $this->croupier->dealCards();

        $this->gameIsPrepared = true;
    }

    public function play()
    {
        if (!$this->gameIsPrepared){
            $this->prepare();
        }
        while (!$this->gameIsFinished){
            foreach($this->players as $player){

                echo $player->getName() . ' würfelt' . PHP_EOL;

                $color = $this->cube->roll();
                echo 'Es wurde ' . $color . ' gewürfelt' . PHP_EOL;

                if ($player->hasCard($color)){
                    echo $player->getName() . ' legt ' . $color . ' weg' . PHP_EOL;
                }
                if ($player->hasCardsLeft() == false){
                    echo $player->getName() . ' hat gewonnen' . PHP_EOL;
                    $this->gameIsFinished = true;
                    return;
                }
            }
        }
    }
    // @codeCoverageIgnoreEnd
}
