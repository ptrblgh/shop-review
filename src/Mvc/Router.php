<?php

namespace Shopreview\Mvc;

use Shopreview\Mvc\Controller\BaseController;

class Router
{
    const DEFAULT_CONTROLLER = 'Base';
    const CONTROLLER_POSTFIX = 'Controller';
    const DEFAULT_ACTION = 'index';
    const ACTION_POSTFIX = 'Action';

    protected $route = '';
    protected $controller = '';
    protected $action;

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
        $matches = explode("\/", $this->route);

        $pattern = '/^([a-zA-Z0-9_-])+$/';
        
        if (preg_match($pattern, $matches[0])) {
            $this->controller = ucfirst(strtolower($matches[0]));
        }

        if (!empty($matches[1]) && preg_match($pattern, $matches[1])) {
            $this->action = $this->convert($matches[1]);
        }

        if ($this->controller == '')
            $this->controller = self::DEFAULT_CONTROLLER;
    }

    /**
     * Convert method (action) name to camelCase
     * 
     * @param  string $route
     * @return string
     */
    public function convert($routePart)
    {
        $routePartArr = explode('-', $routePart);

        if (count($routePartArr) > 1) {
            array_walk($routePartArr, function (&$value, $index) {
                if ($index > 0) $value = ucfirst($value);
            });
        }

        $routerPart = implode('', $routePartArr);

        return $routePart;
    }

    /**
     * Dispatching request to the proper controller
     */
    public function dispatch()
    {
        $this->parseRoute();

        if (!$this->controller) {
            $controllerName 
                = self::DEFAULT_CONTROLLER . self::CONTROLLER_POSTFIX;
        } else {
            $controllerName = 'Shopreview\Mvc\Controller\\' 
                . $this->controller 
                . self::CONTROLLER_POSTFIX
            ;
        }

        if (!class_exists($controllerName)) {
            header('Location: /');
        }

        $controller = new $controllerName();

        if (!($controller instanceof BaseController)) {
            header('Location: /');
        }

        $methodName = $this->action . self::ACTION_POSTFIX;
        if (!$this->action || !method_exists($controller, $methodName)) {
             $methodName = self::DEFAULT_ACTION . self::ACTION_POSTFIX;
        }

        call_user_func_array(array($controller, $methodName), array()); 
    }
}
