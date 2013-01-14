<?php

class CardSet
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

    /**
     * @return array
     */
    public function getCardSet()
    {
        unset($this->cards);
        $rand = rand(0,5);
        for($count = 0; $count < 6; $count++)
        {
            if ($count !== $rand) {
                $this->cards[] = $this->colors[$count];
            }
        }
        return $this->cards;
    }

}