<?php

interface RandomNumberGeneratorInterface
{
    /**
     * @return int
     */
    public function generate();
}

class RandomNumberGenerator implements RandomNumberGeneratorInterface
{
    public function generate()
    {
        return rand(0, 1000);
    }
}

class RandomNumberGeneratorStub implements RandomNumberGeneratorInterface
{
    public function generate()
    {
        return 1; // vorgegebner Wert
    }
}

class BusinessLogic
{
    private $generator;

    public function __construct(RandomNumberGeneratorInterface $generator)
    {
        $this->generator = $generator;
    }

    public function run()
    {
        // ...

        $randomNumber = $this->generator->generate();

        // ...

        return $randomNumber;
    }
}

$generator = new RandomNumberGeneratorStub();
$logic = new BusinessLogic($generator);

var_dump($logic->run());


class BusinessLogicTest extends PHPUnit_Framework_TestCase
{
    private $generator;
    private $logic;
    private $randomNumber = 123289;

    public function setUp()
    {
        $this->generator = $this->getMock('RandomNumberGeneratorInterface');
        $this->generator->expects($this->any())
            ->method('generate')
            ->will($this->returnValue($this->randomNumber));

        $this->logic = new BusinessLogic($this->generator);
    }

    protected function testRunReturnsRandomNumber()
    {
        $this->assertEquals($this->randomNumber, $this->logic->run());
    }
}

class RandomNumberGeneratorTest extends PHPUnit_Framework_TestCase
{
    private $generator;

    public function setUp()
    {
        $this->generator = new RandomNumberGenerator();
    }

    protected function testRandomNumberIsInteger()
    {
        $this->assertType('int', $this->generator->generate());
    }

    protected function testRandomNumberIsPositive()
    {
        $this->assertGreaterThan(0, $this->generator->generate());
    }

    protected function testRandomNumberIsBelow100000()
    {
        $this->assertLessThan(100000, $this->generator->generate());
    }

    // alternativ:

    protected function testRandomNumberIsIntegerBetween0And100000()
    {
        $result = $this->generator->generate();

        $this->assertType('int', $result);
        $this->assertGreaterThan(0, $result);
        $this->assertLessThan(100000, $result);
    }
}