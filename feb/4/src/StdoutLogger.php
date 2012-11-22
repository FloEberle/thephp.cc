<?php
// No testing needed for echo
// @codeCoverageIgnoreStart
class StdoutLogger implements LoggerInterface
{
    public function log($message)
    {
        echo $message."\n";
    }
}
// @codeCoverageIgnoreEnd
