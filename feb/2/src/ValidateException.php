<?php

class ValidateException extends Exception {
    const INVALID_FORMAT = 1;
    const INVALID_GROUPNR = 2;
    const INVALID_LENGTH = 3;
    const INVALID_CHECKSUM = 4;
}