<?php

namespace Shopreview\Helper\Db;

interface DbInterface
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
