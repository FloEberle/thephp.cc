<?php

class Player
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var
     */
    private $dice;

    /**
     * @var CardGenerator
     */
    private $cardGenerator;

    /**
     * @var array
     */
    private $cards = array();

    /**
     * @param $name
     * @param Dice $dice
     * @param CardGenerator $cardGenerator
     */
    public function __construct($name, Dice $dice, CardGenerator $cardGenerator)
    {
        $this->name = $name;
        $this->cardGenerator = $cardGenerator;
        $this->dice = $dice;
    }

    private function setCards()
    {
        $this->cards = $this->cardGenerator->getCards();
    }

    /**
     * @return string
     */
    public function throwDice()
    {
        return $this->dice->getColor();
    }

    /**
     * @param $color
     * @return bool
     */
    public function hasColor($color)
    {
        if (in_array($color, $this->cards)) {
            return true;
        }
    }

}