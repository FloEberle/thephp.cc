<?php

class UserException extends Exception
{
    const USER_ALREADY_FRIEND = 1;
	const REQUEST_TO_CONFIRM_NOT_FOR_THIS_USER = 2;
	const REQUEST_TO_DECLINE_NOT_FOR_THIS_USER = 3;
	const FRIEND_TO_REMOVE_NOT_A_FRIEND = 4;
}
