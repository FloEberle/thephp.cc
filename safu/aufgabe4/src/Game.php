<?php

class Game
{
    /**
     *
     * @var type boolean
     */
    private $isRunning = true;
    
    /**
     *
     * @var array
     */
    private $players = array();
         
    public function setUp()
    {
        $playerNames = array('Hugo', 'peter', 'hans');
        $colors = array('braun', 'grün', 'gelb', 'grau', 'pink', 'beige');
        $cube = new Cube($colors);
        foreach($playerNames as $name){
            $currentPlayer = new Player($name, $cube);
            
            $playerCardColors = $colors;
            $cardToRemove = rand(0, count($colors) - 1);
            unset($playerCardColors[$cardToRemove]);
            
            foreach ($playerCardColors as $color){
                $card = new Card($color);
                $currentPlayer->addCard($card);
            }

            $this->players[] = $currentPlayer;
        }  
        
        shuffle($this->players);     
    }
    
    public function run()
    {
        
        while ($this->isRunning) {
            foreach($this->players as $player){
               $player->play();
               if(!$player->hasCards()){
                  echo $player->getName().': Ich habe gewonnen!!';
                  $this->stopGame();
                  break;
               }
            }
        }
    }
           
    private function stopGame()
    {
        $this->isRunning = false; 
    }
    
    /**
     * @return array
     */
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     * 
     * @return boolean
     */
    public function getGameStatus()
    {
        return $this->isRunning;
    }
    
}