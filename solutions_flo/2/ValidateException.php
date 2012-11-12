<?php

class ValidationException extends Exception {
}

class IsbnValidationException extends ValidationException {
}

class InvalidGroupException extends IsbnValidationException {
}