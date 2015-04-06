<?php

namespace Shopreview\Mvc\Router;

class Router
{
    protected $route = '';

    /**
     * Constructor for router
     *
     * @param string $route
     */
    public function __construct($route)
    {
        $this->route = $route;
    }

    public function dispatch()
    {
    }
}
