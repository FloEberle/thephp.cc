<?php

class StdoutLogger implements LoggerInterface
{
    public function log($message)
    {
        echo $message."\n";
    }
}
