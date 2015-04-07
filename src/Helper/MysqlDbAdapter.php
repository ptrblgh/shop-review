<?php

namespace Shopreview\Helper;

class MysqlDbAdapter
{
    /**
     * Database server
     * 
     * @var string
     */
    protected $server;

    /**
     * Database username
     * 
     * @var string
     */
    protected $username;

    /**
     * Database user password
     * 
     * @var string
     */
    protected $password;

    /**
     * Database name
     * 
     * @var string
     */
    protected $dbName;

    /**
     * Pdo instance
     * 
     * @var \Pdo
     */
    protected $connection;

    /**
     * Prevent creating a new instance
     */
    protected function __construct()
    {
    }

    /**
     * Prevent unserializing
     */
    private function __wake()
    {
    }

    /**
     * Prevent cloning
     */
    private function __clone()
    {
    }

    /**
     * Create the singleton instance
     *
     * @param string $server MySQL server address
     * @param string $username Database username
     * @param string $password Database password
     * @param string $dbName Database name
     * 
     * @return object singleton
     */  
    public static function getInstance($server, $username, $password, $dbName)
    {
        static $instance = null;

        if (null === $instance) {
            $instance = new static();

            $instance->server = $server;
            $instance->username = $username;
            $instance->password = $password;
            $instance->dbName = $dbName;

            $instance->connect();
        }

        return $instance;
    }

    /**
     * Connect to mysql database
     * 
     * @return boolean
     */
    protected function connect(){
        $dsn = 'mysql:host=' 
            . $this->server 
            . ';dbname=' 
            . $this->dbName 
            . ';charset=utf8'
        ;

        try {
            $this->connection 
                = new \Pdo($dsn, $this->username, $this->password);
        } catch (\PDOException $e) {
            trigger_error($e->getMessage(), E_USER_ERROR);

            return false;
        }
        
        return $this->connection;
    }

    /**
     * Find user by its username
     * 
     * @param string $value username
     * @return object
     */
    public function findUser($value)
    {
        $q = 'SELECT `username` FROM `user` WHERE `username` = :value';

        try {
            $stmt = $this->connection->prepare($q);
            $stmt->execute(array('username' => $value));
        } catch (\PDOException $e) {
            trigger_error($e->getMessage(), E_USER_ERROR);

            return false;
        }

        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Find user email in table
     * 
     * @param string $value username
     * @return object
     */
    public function findEmail($value)
    {
        $q = 'SELECT `username` FROM `user` WHERE `email` = :value';

        try {
            $stmt = $this->connection->prepare($q);
            $stmt->execute(array('username' => $value));
        } catch (\PDOException $e) {
            trigger_error($e->getMessage(), E_USER_ERROR);

            return false;
        }

        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Insert registration data into database
     * 
     * @param array $data
     * @return boolean
     */
    public function saveRegistration($data)
    {
        $userNameExists = $this->findUser($data['register_username']);
        $emailExists = $this->findUser($data['register_username']);

        if ((!empty($data) && is_array($data)) 
            && ($data['register_username'] >= 3 
                && $data['register_username'] <= 20
                && !$userNameExists)
            && (!empty($data['register_psw']) 
                && $data['register_psw'] === $data['register_psw2'])
            && (!empty($data['register_email']) && !$emailExists)
        ) {
            $q = 'INSERT INTO `user` '
                . '(`username`, `password`, `email`) '
                . 'VALUES (:register_username, `:register_password`, `:register_email`)'
            ;

            try {
                $stmt = $this->connection->prepare($q);
                $stmt->execute($data);
            } catch (\PDOException $e) {
                trigger_error($e->getMessage(), E_USER_ERROR);

                return false;
            }
        }
    }

    /**
     * Close the connection
     *
     * @return boolean
     */
    public function close(){
        if (isset($this->connection)) {
            $this->connection = null;
            unset($this->connection);

            return true;
        }

        return false;
    }

    /**
     * Destructor
     *
     * @return void
     */
    public function __destruct(){
        $this->close();
    }
}