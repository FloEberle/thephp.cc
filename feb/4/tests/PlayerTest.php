<?php

/**
 * @covers Player
 */
class PlayerTest extends AbstractTest
{
    private $color;
    private $player;
    protected function setUp()
    {
        parent::setUp();
        $this->color = 'GREEN';

    }

    public function testSetAndGetName()
    {
        $player = new Player($this->configurationMock, $this->gameMock, $this->loggerMock, $this->diceMock);
        $name = 'bruce schneier';
        $player->setName($name);
        $this->assertSame($name, $player->getName());
    }

    public function testAddAndGetCards()
    {
        $player = new Player($this->configurationMock, $this->gameMock, $this->loggerMock, $this->diceMock);
        $card = new Card($this->color);
        $player->addCard($card);
        $this->assertSame(array($card), $player->getCards());
    }

    public function testMakeMoveAndFinishGame()
    {
        $this->diceMock->expects($this->once())->method('getRandomColor')->will($this->returnValue($this->color));
        $this->gameMock->expects($this->once())->method('stopGame');
        $player = new Player($this->configurationMock, $this->gameMock, $this->loggerMock, $this->diceMock);
        $card = new Card($this->color);
        $player->addCard($card);
        $player->makeMove();
        $this->assertEmpty($player->getCards());
    }

    public function testMakeMoveAndContinueGame()
    {
        $this->diceMock->expects($this->once())->method('getRandomColor')->will($this->returnValue($this->color));
        $this->gameMock->expects($this->never())->method('stopGame');
        $player = new Player($this->configurationMock, $this->gameMock, $this->loggerMock, $this->diceMock);
        $card = new Card('COLOR_NOT_FROM_DICE');
        $player->addCard($card);
        $player->makeMove();
        $this->assertNotEmpty($player->getCards());
    }
}