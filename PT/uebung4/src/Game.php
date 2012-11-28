<?php

class Game
{
    private $gameStatus = '';
    public function __construct(Configuration $configuration,
                                GameColors $gameColors,
                                Cube $cube,
                                PlayerCollection $playerCollection)
    {
        $this->configuration = $configuration;
        $this->gameColors = $gameColors;
        $this->cube = $cube;
        $this->playerCollection = $playerCollection;
    }

    public function prepare()
    {
        foreach ($this->playerCollection->getPlayerNames() as $name){
            $this->playerCollection->add(new Player(new PlayerCards($this->gameColors), $name));
        }
        $this->gameStatus = 'prepared';
    }

    public function play()
    {
        if (!$this->gameStatus == 'prepared'){
            throw new InvalidArgumentException('Spiel muss zuerst vorbereitet werden');
        }
        while ($this->gameStatus != 'over'){
            foreach($this->playerCollection->getPlayers() as $player){

                echo $player->getName() . ' würfelt' . PHP_EOL;

                $color = $this->cube->roll();
                echo 'Es wurde ' . $color . ' gewürfelt' . PHP_EOL;

                if ($player->hasCardColor($color)){
                    $player->removeCard($color);
                    echo $player->getName() . ' legt ' . $color . ' weg' . PHP_EOL;
                }
                if ($player->hasCards() == false){
                    echo $player->getName() . ' hat gewonnen' . PHP_EOL;
                    $gameStatus = 'over';
                    return;
                }
            }
        }
    }
}
