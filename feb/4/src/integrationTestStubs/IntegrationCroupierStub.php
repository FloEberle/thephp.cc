<?php
// Stub needs no testing
// @codeCoverageIgnoreStart
class IntegrationCroupierStub implements CroupierInterface
{
    public function shuffle(array $arrayToShuffle)
    {
        //We wont shuffle here
        return $arrayToShuffle;
    }
}
// @codeCoverageIgnoreEnd
