<?php

$db = mysqli_connect();
define('DATA_DIR', '/path/to/datadir');
$_POST['username'] = 'Fred';

$config = array(
    'dsn' => '...',
    'loggingEnabled' => true,
    ...
);

class Foo
{
    public function doSomething($a, $b, $c)
    {
        global $db;
        global $config;
        
        // ...
        
        $dsn = $config['dsn'];
        
        // ...
        
        $collaborator = new Collaborator();
        
        $collaborator->someMethod(...);

        // ...
        
        if (today_is_monday()) {
            $result = SomeOtherClass::aMethod(...);
        }
        
        // ...

        $result = $db->query(...);

        // ...
        
        $conn = mysql_connect(...);
        
        // ...                
        
        $data = file_get_contents(DATA_DIR . '/config.ini');
        
        // ...
        
        $username = $_POST['username'];
    }
}
