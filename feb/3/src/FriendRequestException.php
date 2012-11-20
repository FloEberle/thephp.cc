<?php

class FriendRequestException extends Exception
{
    const ADD_YOURSELF_AS_FRIEND = 1;
    const FRIEND_ALREADY_EXISTS = 2;
    const FRIEND_NOT_FOUND = 3;
    const FRIENDREQUEST_NOT_FOUND = 4;
    const FRIENDREQUEST_REQUIRES_DIFFERENT_USERS = 5;
}
