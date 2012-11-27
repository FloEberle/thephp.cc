<?php

class CardGenerator
{

    /**
     * @var array
     */
    private $cards = array();

    /**
     * @var array
     */
    private $colors;

    /**
     * @param array $colors
     */
    public function __construct(array $colors)
    {
        $this->colors = $colors;
    }

    private function generateCardSet()
    {
        unset($this->cards);
        $rand = rand(1,6);
        for($count = 1; $count < 7; $count++)
        {
            if ($count !== $rand) {
                $this->cards[] = $this->colors[$count];
            }
        }
    }

    /**
     * @return array
     */
    public function getCards()
    {
        $this->generateCardSet();
        return $this->cards;
    }

}