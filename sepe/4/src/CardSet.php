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

    private function generateCardSet()
    {
        unset($this->cards);
        $rand = rand(0,5);
        for($count = 0; $count < 6; $count++)
        {
            if ($count !== $rand) {
                $this->cards[] = $this->colors[$count];
            }
        }
    }

    /**
     * @return array
     */
    public function getCardSet()
    {
        $this->generateCardSet();
        return $this->cards;
    }

    /**
     * @param $color
     * @return bool
     */
    public function hasColor($color)
    {
        return in_array($color, $this->cards);
    }

}