<?php

namespace Shopreview\Mvc;

class Router
{
    const CONTROLLER = 'Controller';
    const ACTION = 'index';
    const ACTION_PREFIX = 'Action';

    protected $route = '';
    protected $action;
    protected $params = array();
    protected $view;

    /**
     * Constructor for router
     *
     * @param string $route
     */
    public function __construct($route = '')
    {
        $route = isset($route) 
            ? preg_replace('/^route=(.*)/','$1',$_SERVER['QUERY_STRING']) 
            : '';
        
        $this->route = $route;
    }

    /**
     * Parsing controller, action and parameters from route
     */
    protected function parseRoute()
    {       
            $matches = explode("\\", $this->route);

            // only the first part of the route needed right now (light)
            if (!empty($matches[0])) {
                $this->action = $matches[0];
            }

            // the second part is a digit, use as an id
            if (!empty($metches[1]) && is_numeric($matches[1])) {
                $this->params['id'] = $matches[1];
            }
    }

    /**
     * Dispatching request to the proper controller
     */
    public function dispatch()
    {
        $this->parseRoute();

        $controllerName = self::CONTROLLER;
        $methodName = $this->action . self::ACTION_PREFIX;
        $controller = new $controllerName;

        if (!method_exists($controller, $methodName)) {
            $methodName = self::ACTION . self::ACTION_PREFIX;
        }

        // call action method
        $this->view = call_user_func_array(
            array($controller, $methodName), 
            $this->params
        );

        // print out the html
        echo $this->view;
    }
}
