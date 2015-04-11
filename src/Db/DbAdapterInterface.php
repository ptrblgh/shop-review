<?php

namespace Shopreview\Db;

interface DbAdapterInterface
{
    public static function getInstance(
        $server, 
        $driver, 
        $username, 
        $password, 
        $dbName
    );
    
    public function close();
}
