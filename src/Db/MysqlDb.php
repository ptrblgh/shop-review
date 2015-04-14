<?php

namespace Shopreview\Db;

/**
 * Mysql database adapter
 * 
 * @author Péter Balogh <peter.balogh@theory9.hu>
 * @link https://github.com/ptrblgh/shop-review for source
 * @link http://shop-review.theory9.hu for demo
 */
class MysqlDb implements DbAdapterInterface
{
    /**
     * Database server
     * 
     * @var string
     */
    protected $server;

    /**
     * Driver
     * 
     * @var string
     */
    protected $driver;

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
     *
     * @return void
     */
    protected function __construct()
    {
    }

    /**
     * Prevent unserializing
     *
     * @return void
     */
    private function __wake()
    {
    }

    /**
     * Prevent cloning
     *
     * @return void
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
    public static function getInstance(
        $server, 
        $driver,
        $username, 
        $password, 
        $dbName
    ) {
        static $instance = null;

        if (null === $instance) {
            $instance = new static();

            $instance->connect($server, $driver, $username, $password, $dbName);
        }

        return $instance;
    }

    /**
     * Connect to mysql database
     * 
     * @return boolean
     */
    protected function connect(
        $server, 
        $driver, 
        $username, 
        $password, 
        $dbName
    ) {

        $this->server = $server;
        $this->username = $username;
        $this->password = $password;
        $this->dbName = $dbName;

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