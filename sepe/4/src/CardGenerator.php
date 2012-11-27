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
    private $colors = array (
    1 => 'red',
    2 => 'blue',
    3 => 'yellow',
    4 => 'green',
    5 => 'black',
    6 => 'white'
    );

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