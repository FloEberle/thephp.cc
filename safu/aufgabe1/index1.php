<?php

require_once __DIR__ . '/aufgabe1Brack.php';

$realName   = 'Hans Muster';
$screenName = 'Nvidia';

$user1 = new User(1, $realName, 'mustee@muster.ch');
$user2 = new User(2, 'Peter Muster', 'peter.muster@test.ch', $screenName);

if ($user1->getScreenName() == $realName) {
    print 'RealName wird verwendet: OK' . PHP_EOL;
}
if ($user2->getScreenName() == $screenName) {
    print 'ScreenName wird verwendet: OK' . PHP_EOL;
}

/*
    Aufgabe C:

    Ich würde einfach die Funktion setScreenName() aufrufen und einfach ein lerer String übergeben.

*/

$user2->deleteScreenName();

var_dump($user2->getScreenName());