<?php
include 'Isbn.php';
include 'ValidateException.php';

$valid_isbns = array('978 3 86680 192 9', '978-3-49806-056-5');
$invalid_isbns = array('5-garbage', 'sdf-23423-sdfsd', '635-5-51568-300-15', '111 1 11111 111 1',);

foreach (array_merge($valid_isbns, $invalid_isbns) as $isbn) {
	try {
	    new Isbn($isbn);
        echo 'success: '.$isbn."\n";
	} catch (ValidateException $e){
	    echo 'failed: '.$e->getMessage()."\n";
	}
}
// ====================================
/**
 * Copycat Code
 * @see http://php.net/manual/en/language.oop5.object-comparison.php
 */
function bool2str($bool)
{
    if ($bool === false) {
        return 'FALSE';
    } else {
        return 'TRUE';
    }
}

function compareObjects(&$o1, &$o2)
{
    echo 'o1 == o2 : ' . bool2str($o1 == $o2) . "\n";
    echo 'o1 != o2 : ' . bool2str($o1 != $o2) . "\n";
    echo 'o1 === o2 : ' . bool2str($o1 === $o2) . "\n";
    echo 'o1 !== o2 : ' . bool2str($o1 !== $o2) . "\n";
}

$o = new Isbn($valid_isbns[0]);
$p = new Isbn($valid_isbns[0]);
$q = $o;
$r = new Isbn($valid_isbns[1]);
$s = clone $r;

echo "Two instances of the same class\n";
compareObjects($o, $p);

echo "\nTwo references to the same instance\n";
compareObjects($o, $q);

echo "\nTwo instances of the same class with different attributes\n";
compareObjects($o, $r);

echo "\nCloned (shallow copy) instance\n";
compareObjects($r, $s);

