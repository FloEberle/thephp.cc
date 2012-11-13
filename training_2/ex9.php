<?php

class User
{
    private $name;
    private $id = 42;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }
}

interface LoaderInterface
{
    public function findUserById($id);
}

interface SaverInterface
{
    public function saveUser(User $user);
}

class MysqlLoader implements LoaderInterface
{
    private $mysqli;

    public function __construct(Mysqli $mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public function findUserById($id)
    {
        $query = $this->mysqli->query('SELECT name FROM Users WHERE id=' . (int) $id . ' LIMIT 1');
        return $query->fetch_assoc();
    }
}

class MysqlSaver implements SaverInterface
{
    private $mysqli;

    public function __construct(Mysqli $mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public function saveUser(User $id)
    {
        $name = $user->getName();
        $this->mysqli->exec('INSERT INTO name VALUES ... $name ...');
    }
}

class MigrationUserRepository implements LoaderInterface, SaverInterface
{
    public function findUserbyId($id)
    {
        try {
            return $this->loadUserFromNewDatabase($id);
        }

        catch (Exception $e) {
            return $this->loadUserFromOldDatabase($id);
        }
    }

    public function saveUser(User $user)
    {
        $this->saveUserToNewDatabase($user);
    }
}


class UserRepository implements LoaderInterface, SaverInterface
{
    private $keyValueStore;

    public function __construct(KeyValueStoreInterface $keyValueStore)
    {
        $this->keyValueStore = $keyValueStore;
    }

    public function findUserById($id)
    {
        return $this->keyValueStore->load($this->toKey($id));
    }

    public function saveUser(User $user)
    {
        $this->keyValueStore->save($this->toKey($user->getId()), $user);
    }

    private function getPrefix()
    {
        return 'another_prefix';
    }

    private function toKey($id)
    {
        return $this->getPrefix() . '_' . $id;
    }
}

interface KeyValueStoreInterface
{
    public function load($key);
    public function save($key, $value);
}

class ReallyFancyKeyValueStore implements KeyValueStoreInterface
{
    private $data = array();

    public function load($key)
    {
        return $this->data[$key];
    }

    public function save($key, $value)
    {
        $this->data[$key] = $value;
    }
}

$mysqli = new Mysqli();
$loader = new MysqlLoader($mysqli);

$keyValueStore = new ReallyFancyKeyValueStore();
$userRepository = new UserRepository($keyValueStore);

// $userRepository = new MigrationUserRepository($oldDatabaseRepository, $newDatabaseRepository);

// ---

$userRepository->saveUser(new User('Stefan'));

// ---

var_dump($userRepository->findUserById(42));