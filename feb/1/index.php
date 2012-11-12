<?php

require __DIR__ . '/User.php';

$user = new User(1, 'Bruce Schneier', 'peter.fox@foobar.com');
var_dump($user->getScreenName());

$user2 = new User(2, 'Martin Fowler', 'martin.fowler@foobar.com');
$user2->setScreenName('OOP rocks');

var_dump($user2->getScreenName());

/* Loesungsvorschlag fuer c)
 * --------------------------
 * Man uebergibt dem Benutzer als Screenname null, somit wird er zurueckgesetzt.
 * Schoener waere: Man fuehrt eine Methode zum zuruecksetzen ein.
 *
 */

//Proof c)
$user2->setScreenName(null);
var_dump($user2->getScreenName());