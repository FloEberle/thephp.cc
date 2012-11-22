<?php
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
        $player = new Player($this->configurationStub, $this->gameStub, $this->loggerStub, $this->diceStub);
        $name = 'bruce schneier';
        $player->setName($name);
        $this->assertSame($name, $player->getName());
    }
}