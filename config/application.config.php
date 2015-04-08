<?php

return array(
    // application-wide config comes here
    'template_path' => 'view',
    'db' => array(
        'server' => 'localhost',
        'driver' => 'mysql',
        'username' => 'shop-review',
        'password' => 'test',
        'dbname' => 'shop-review'
    ),
    'mail' => array(
        'host' => 'localhost',
        'port' => '',
        'from' => 'noreply@localhost',
        'from_name' => 'Shop review'
    )
);
