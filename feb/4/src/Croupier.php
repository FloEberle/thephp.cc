<?php
// Shuffle needs no testing
// @codeCoverageIgnoreStart
class Croupier implements CroupierInterface
{

    /**
     * @param array $arrayToShuffle
     *
     * @return array
     */
    public function shuffle(array $arrayToShuffle)
    {
        shuffle($arrayToShuffle);
        return $arrayToShuffle;
    }
}
// @codeCoverageIgnoreEnd