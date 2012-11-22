<?php
// Stub needs no testing
// @codeCoverageIgnoreStart
class IntegrationFactory extends Factory
{
    public function getInstanceFor($type)
    {
        switch ($type) {
            case 'Croupier':
                return new IntegrationCroupierStub();
            case 'Dice':
                return new IntegrationDiceStub();
            case 'Logger':
                return new IntegrationLogger();
            default:
                return parent::getInstanceFor($type);
        }
    }
}
// @codeCoverageIgnoreEnd
