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
        'port' => 25,
        'from' => 'noreply@localhost',
        'from_name' => 'Shop review'
    ),
    'reviews' => array(
        // number of reviews (start and loaded by ajax loader)
        'batch' => 3,
        // (how many complete words - by characters - appear before 'more' in 
        // review body)
        'body_lead' => 150 
    )
);
