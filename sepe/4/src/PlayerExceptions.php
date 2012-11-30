<?php

class PlayerException extends Exception
{
    const PLAYER_DOES_NOT_HAVE_THIS_COLOR = 1;
    const PLAYER_DOES_NOT_HAVE_CARDS = 2; // es wurden keine Karten ausgegeben.
}
