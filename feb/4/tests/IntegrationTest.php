<?php

/**
 *
 * Pseudo Integrationstest. Spielt mit vorgegebenen Testsettings. Der Croupier ist ein Stub der nicht mischt,
 * der Dice gibt die im Test vorgegebenen Farben aus. Dadurch ist der Gewinner des Spiel vorhersehbar.
 *
 * @covers Game
 */
class IntegrationTest extends PHPUnit_Framework_TestCase
{

    public function testIntegrationRunWholeGame()
    {
        $configuration = new Configuration(__DIR__ . '/../config/settings_test.ini');
        $factory = new IntegrationFactory($configuration);
        $game = $factory->getInstanceFor('Game');
        $game->initialize();
        $game->play();
        $this->assertSame('Alice', $game->getWinner()->getName());
    }

    /**
     * @expectedException LogicException
     */
    public function testIntegrationTryStartGameWithoutInitializing()
    {
        $configuration = new Configuration(__DIR__ . '/../config/settings_test.ini');
        $factory = new IntegrationFactory($configuration);
        $game = $factory->getInstanceFor('Game');
        $game->play();
    }
}