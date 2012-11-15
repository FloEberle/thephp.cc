<?php
class friendRequestException extends Exception 
{
}

class itselfRequestException extends friendRequestException
{
}

class alreadyRequestException extends friendRequestException
{
}

class notFoundRequestException extends friendRequestException
{
}
