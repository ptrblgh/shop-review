<?php

namespace Shopreview\Mvc;

class Router
{
    protected $route = '';

    /**
     * Constructor for router
     *
     * @param string $route
     */
    public function __construct($route = '')
    {
        $route = isset($route) 
            ? preg_replace('/^_route=(.*)/','$1',$_SERVER['QUERY_STRING']) 
            : '';
        
        $this->route = $route;
    }

    public function dispatch()
    {
    }
}
