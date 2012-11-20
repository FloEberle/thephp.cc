<?php

class User
{
    public function __construct(Database $database)

    ... $this->database->loadUserData($id) ...
}

class Database
{
    public function loadUserData($id)
    {
        // ... SQL ...

        return $db-result;
    }
}

class DatabaseStub extends Database
{
    public function loadUserData(id)
    {
        return array(
            'id'   => 42,
            'name' => 'Stefan',
        );
    }
}

class DatabaseStubForAnotherTestcase extends Database
{
    public function loadUserData(id)
    {
        return array(
            'id'   => 42,
            'name' => 'Franz',
        );
    }
}