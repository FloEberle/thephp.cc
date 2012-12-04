<?php

require __DIR__ . '/uebung1.php';

// vorher definierte User IDs die "von irgendwo her" kommen
$userIdUser1 = '1';
$userIdUser2 = '2';

// Aufgaben Teil b)
$user1 = new User($userIdUser1, 'Helge Müller', 'helge.mueller@competec.ch');
$user2 = new User($userIdUser2, 'Stefan Priebsch', 'stefan.priebsch@thephp.cc', 'spriebsch');

/** testcases
// $user1 = new User('1', '', 'helge.mueller@competec.ch', 'HelgeM');
// testcase - keine Mailadresse (required)
// $user1 = new User('1', 'Helge M�ller', '', 'HelgeM');
*/


var_dump($user1);
var_dump($user2);
