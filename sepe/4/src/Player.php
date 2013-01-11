<?php

class Player
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var Dice
     */
    private $dice;

    /**
     * @var CardSet
     */
    private $cardSet;

    /**
     * @var array
     */
    private $cards = array();

    /**
     * @param $name
     * @param Dice $dice
     * @param CardSet $cardSet
     */
    public function __construct($name, Dice $dice, CardSet $cardSet)
    {
        $this->name = $name;
        $this->cardSet = $cardSet;
        $this->dice = $dice;
    }

    /**
     * @return string
     */
    public function rollDice()
    {
        return $this->dice->getColor();
    }

    /**
     * @param $color
     * @return bool
     */
    public function hasColor($color)
    {
        return in_array($color, $this->cards);
    }

    /**
     * @param $color
     * @throws PlayerException
     */
    public function turnCard($color)
    {
        if (!in_array($color, $this->cards)) {
            throw new PlayerException('Der Spieler hat die Farbe ' . $color . ' nicht.',1);
        }

        foreach ($this->cards as $key => $value) {
            if ($value === $color) {
                unset($this->cards[$key]);
                return;
            }
        // @codeCoverageIgnoreStart
        }
    }
    // @codeCoverageIgnoreEnd

    public function getCardSet()
    {
        $this->cards = $this->cardSet->getCardSet();
    }

    /**
     * @return int
     */
    public function getCountCards()
    {
        return count($this->cards);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}