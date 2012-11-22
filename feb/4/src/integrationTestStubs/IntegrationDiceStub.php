<?php
// Stub needs no testing
// @codeCoverageIgnoreStart
class IntegrationDiceStub implements DiceInterface
{
    public static $counter = 0; //Colors returned globally by all Dice Instances
    private $colorsToReturn = array('RED', 'RED', 'RED',
                                    'BLUE', 'BLUE', 'BLUE',
                                    'GREEN', 'GREEN', 'GREEN',
                                    'YELLOW', 'YELLOW', 'YELLOW',
                                    'BLACK', 'BLACK', 'BLACK',
                                    'WHITE', 'WHITE', 'WHITE');

    public function getRandomColor()
    {
        return $this->colorsToReturn[IntegrationDiceStub::$counter++];
    }
}
// @codeCoverageIgnoreEnd