<?php

$application = new Application();
$application->run();

class Application
{
    public function run()
    {
        $logic = new Logic();
        
        try {
            $logic->execute();
        }
        
        catch (Exception $e) {
            var_dump('Something went wrong');
            var_dump($e);
        }
    }
}

class Logic
{
    public function execute()
    {
        $dataAccess = new DataAccess();
        try {
            $data = $dataAccess->load();
        }
        
        catch (Exception $e) {
            throw new RuntimeException('...', 0, $e);
        }
    }
}

class DataAccess
{
    public function load()
    {
        // ...
    
        $lastError = 'The SQL statement contained some bullshit ...'; // $db->getLastError();
        throw new DataAccessException('Could not load data', $lastError);
    }
}

class DataAccessException extends Exception
{
    private $dbError;

    public function __construct($message, $dbError)
    {
        parent::__construct($message);
        $this->dbError = $dbError;
    }
    
    public function getDbError()
    {
        return $this->dbError;
    }
}
