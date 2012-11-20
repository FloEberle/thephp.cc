<?php

class UserException extends Exception 
{
    
}

class MissingFriendRequestException extends UserException
{

}

class ForeignFriendRequestException extends UserException
{

}

class SelfReferencingFriendRequestException extends UserException
{

}

class InvalidFriendRemovalException extends UserException
{

}

class FriendRequestException  extends Exception
{

}

