<?php

class Factory
{
    private $configData = array();
    private $request;
    private $configuration;
    private $session;

    public function __construct(array $configData, $request)
    {
        $this->configData = $configData;
        $this->request    = $request;
    }

    public function getInstanceFor($class)
    {
        switch ($class) {

            'Session'  
                if ($this->session === null) {
                    $this->session = new Session($_SESSION);
                }
                return $this->session;
        
            'Configuration':
                if ($this->configuration === null) {
                    $this->configuration = new Configuration($this->configData);
                }
                return $this->configuration;
        
            'LdapAuthenticator':
                return new LdapAuthenticator();
                
            'FileAuthenticator':
                return new FileAuthenticator($this->getInstanceFor('Configuration')->getPasswdPath());

            'AuthenticationController':
                if ($this->getInstanceFor('Configuration'))->getAuthenticationSource() == 'ldap') {
                    $authenticator = $this->getInstanceFor('LdapAuthenticator');
                } else {
                    $authenticator = $this->getInstanceFor('FileAuthenticator');
                }
                return AuthenticationController($this->getInstanceFor('Session'), $authenticator);

            'FrontController':
                return new FrontController($this);
        }
    }
}




class Configuration
{
    private $data = array();
    
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function hasAuthenticationSource()
    {
        return isset($this->data['auth_source']);
    }

    public function getAuthenticationSource()
    {
        if (!$this->hasAuthenticationSource()) {
            throw new RuntimeException('Key "auth_source" does not exist');
        }
    
        return $this->data['auth_source'];
    }
    
    public function getPassdFilePath()
    {
        return $this->data['passwd_path'];
    }
    
    // ...
}

class PostRequest
{
    private $data = array();
    
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function hasParameter($key)
    {
        return isset($this->data[$key]);
    }

    public function getParameter($key)
    {
        if (!$this->hasParameter($key)) {
            throw new RuntimeException('Parameter "' . $key . '" does not exist');
        }
    
        return $this->data[$key];
    }
}

class Session
{
    private $data = array();

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function set($key, $value)
    {
        $this->data[$key] = $value;
    }
    
    public function has($key)
    {
        return isset($this->data[$key]);
    }
    
    public function get($key)
    {
        return $this->data[$key];
    }
    
    public function getData()
    {
        return $this->data;
    }
    
    public function setUsername($username)
    {
        if (!is_string($username)) {
            throw new RuntimeException('...');
        }

        $this->set('username', $username);
    }
}

interface AuthenticatorInterface
{
    public function authenticate($username, $password);
}

class LdapAuthenticator implements AuthenticatorInterface
{
    // ...
}

class FileAuthenticator implements AuthenticatorInterface
{
    private $passwdPath;

    public function __construct($passwdPath)
    {
        $this->passwdPath = $passwdPath;
    }

    public function authenticate($username, $password)
    {
        $passwords = file($this->passwdPath);
        return isset($passwords[$username]) && $passwords[$username] == $password;
    }
}

class DatabaseAuthenticator implements AuthenticatorInterface
{
    public function authenticate($username, $password)
    {
        // ...
    }
}

class AuthenticatorStub implements AuthenticatorInterface
{
    public function authenticate($username, $password)
    {
        return true;
    }
}

// bootstrap:

// $configData = parse_ini_file('/path/to/config.ini');

$configData = array(
    'auth_source' => 'ldap',
    'passwd_path' => '/path/to/passwd',
);

$request = new PostRequest(array('username' => 'the-user', 'password' => 'the-password'));
$factory = new Factory($configData, $request);
$frontController = $factory->getInstanceFor('FrontController')->execute();

// ... ganz viel Abstand ...

// applikation:

class FrontController
{
    private $factory;

    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }
    
    public function execute()
    {
        // ...routing ...

        $controller = $this->factory->getInstanceFor('AuthenticationController');
        $controller->execute($request);

        $_SESSION = $session->getData();
    }
}

/**
 * Authenticate user against various authentication backends
 */
class AuthenticationController
{
    private $session;
    private $authenticator;

    public function __construct(Session $session, AuthenticatorInterface $authenticator)
    {
        $this->session       = $session;
        $this->authenticator = $authenticator;
    }

    /**
     * Authenticates the user from POST request
     *
     * Stores username into session on successful authentication.
     *
     * @param PostRequest $request
     * @return bool
     */
    public function execute(PostRequest $request)
    {
        $username = $request->getParameter('username');
        $password = $request->getParameter('password');

        $result = $this->authenticator->authenticate($username, $password);
        
        if ($result) {
            $this->session->setUsername($username);
        }

        return $result;
    }
}
