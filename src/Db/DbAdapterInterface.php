<?php

namespace Shopreview\Db;

/**
 * Interface for database adapters
 * 
 * @author Péter Balogh <peter.balogh@theory9.hu>
 * @link https://github.com/ptrblgh/shop-review for source
 * @link http://shop-review.theory9.hu for demo
 */
interface DbAdapterInterface
{
    /**
     * Retrive adapter instance
     *
     * @static
     * @param string $server server address
     * @param string $driver database driver
     * @param string $username database username
     * @param string $password database password
     * @param string $dbName database name
     * @return object
     */
    public static function getInstance(
        $server, 
        $driver, 
        $username, 
        $password, 
        $dbName
    );
    
    /**
     * Closing datbase connection 
     * 
     * @return void|boolean
     */
    public function close();
}
