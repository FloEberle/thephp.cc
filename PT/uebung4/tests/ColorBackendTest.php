<?php

class ColorBackendStub extends ColorBackend
{
    public function readIniFile()
    {
        return array('colors' => array('red', 'yellow', 'blue', 'green', 'brown', 'violet'));
    }
}
