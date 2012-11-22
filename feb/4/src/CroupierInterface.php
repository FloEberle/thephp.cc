<?php


interface CroupierInterface
{
    /**
     * @param array $arrayToShuffle
     *
     * @return array
     */
    public function shuffle(array $arrayToShuffle);
}
