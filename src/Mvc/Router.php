<?php

namespace Shopreview\Mvc;

use Shopreview\Mvc\Controller\BaseController;

/**
 * Default router class for application
 * 
 * @author Péter Balogh <peter.balogh@theory9.hu>
 * @link https://github.com/ptrblgh/shop-review for source
 * @link http://shop-review.theory9.hu for demo
 */
class Router
{
    const DEFAULT_CONTROLLER = 'Base';
    const CONTROLLER_POSTFIX = 'Controller';
    const DEFAULT_ACTION = 'index';
    const ACTION_POSTFIX = 'Action';

    /**
     * Route from the url
     * 
     * @var string
     */
    protected $route = '';

    /**
     * Controller from the route
     * 
     * @var string
     */
    protected $controller = '';

    /**
     * Action from the route
     * 
     * @var string
     */
    protected $action;

    /**
     * Constructor for router (with the help of .htaccess)
     *
     * @param string $route
     * @return void
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
     *
     * @return void
     */
    protected function parseRoute()
    {       
        $matches = explode("/", $this->route);

        $pattern = '/^([a-zA-Z0-9_-])+$/';
        
        if (preg_match($pattern, $matches[0])) {
            $this->controller = ucfirst(strtolower($matches[0]));
        }

        if (!empty($matches[1]) && preg_match($pattern, $matches[1])) {
            $this->action = $this->convert($matches[1]);
        }
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
                if ($index > 0) {
                    $value = ucfirst($value);
                }
            });
        }

        $routePart = implode('', $routePartArr);

        return $routePart;
    }

    /**
     * Dispatching request to the proper controller
     *
     * @return void
     */
    public function dispatch()
    {
        $this->parseRoute();

        $controller = new BaseController();

        $controllerName = '\\Shopreview\\Mvc\\Controller\\' . $this->controller . self::CONTROLLER_POSTFIX;

        // controller test, if not found redirect to the homepage
        if (class_exists($controllerName)) {
            $controller = new $controllerName();
        } elseif(!empty($this->controller)) {
            header('Location: /');
            exit();
        }

        // finalizing method name
        $methodName = $this->action . self::ACTION_POSTFIX;
        if (!$this->action || !method_exists($controller, $methodName)) {
            $methodName = self::DEFAULT_ACTION . self::ACTION_POSTFIX;
        }

        // calling the proper class and method
        call_user_func_array(array($controller, $methodName), array());
    }
}
