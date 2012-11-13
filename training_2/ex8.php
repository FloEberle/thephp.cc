<?php

$liquid = new Beer();
$bottle = new Bottle($liquid);

$consumer = new Consumer();
$consumer->drink($bottle);

interface Liquid
{
    public function pour();
}

class ClubMate implements Liquid
{
    public function pour()
    {
        // ... ganz ganz langsam ...
    }
}

abstract class BaseLiquid implements Liquid
{
    public function pour()
    {
        // ...
    }
}

class Beer extends BaseLiquid
{
}

class Coke extends BaseLiquid
{
}

class Bottle
{
    public function __construct(Liquid $liquid)
    {
        $this->content = $liquid->pour();
    }
}

class Consumer
{
    public function drink(Bottle $bottle)
    {
        // ...
    }
}