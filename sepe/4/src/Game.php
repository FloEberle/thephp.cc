<?php
// @codeCoverageIgnoreStart
class Game
{

    /**
     * @var array
     */
    private $playerCollection;

    /**
     * @var int
     */
    private $status;

    /**
     * @var array
     */
    private $players;

    /**
     * @var string;
     */
    private $winner;

    public function __construct(PlayerCollection $playerCollection)
    {
        $this->playerCollection = $playerCollection;
        $this->players = $this->playerCollection->getPlayers();
    }

    public function shareCards()
    {
        foreach ($this->players as $key => $value) {
            $this->players[$key]->getCardSet();
        }
    }

    public function start()
    {
        $this->status = 1;
        while ($this->status == 1)
        {
            foreach ($this->players as $player) {

                if ($player->getCountCards() === 0) {
                    throw new PlayerException('Der Spieler ' . $player . ' hat keine Karten.',2);
                }

                $color = $player->rollDice();
                if ($player->hasColor($color)) {
                    $player->turnCard($color);
                }
                if ($player->getCountCards() === 0) {
                   $this->status = 2;
                   $this->winner = $player->getName();
                }
            }
        }

        echo 'And the winner ist ' . $this->winner . PHP_EOL;
    }
}
// @codeCoverageIgnoreEnd