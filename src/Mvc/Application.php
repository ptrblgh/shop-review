<?php

namespace Shopreview\Mvc;

use Shopreview;
use Shopreview\Helper;
use Shopreview\Session;
use Shopreview\Mvc\Router;

/**
 * Shop review application singleton class
 * 
 * @author Péter Balogh <peter.balogh@theory9.hu>
 * @link https://github.com/ptrblgh/shop-review for source
 * @link http://shop-review.theory9.hu for demo
 */
class Application
{
    protected $config;

    /**
     * Prevent creating a new instance
     *
     * @return void
     */
    protected function __construct()
    {
    }

    /**
     * Create the singleton instance
     *
     * Returns the singleton instance of the application and sets the
     * configuration parameters.
     * 
     * @param  array  $config application configuration parameters
     * @return object singleton
     */
    public static function getInstance($config = array())
    {
        static $instance = null;

        if (null === $instance) {
            $instance = new static();

            if (!empty($config) && is_array($config)) {
                $instance->config = $config;
            }
        }
        return $instance;
    }

    /**
     * Run the application
     *
     * @return void
     */
    public function run()
    {
        // start session
        $sess = Session::getInstance();

        // some polish helpers
        Helper::removeMagicQuotes();
        Helper::unregisterGlobals();

        // dispatching to route
        $route = isset($_GET['route']) ? $_GET['route'] : '';
        $router = new Router($route);
        $router->dispatch();
        
        // speed up concurrent connections
        $sess->writeSession();
    }

    /**
     * Getter for application config
     * 
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Prevent unserializing
     * 
     * @return void
     */
    private function __wake()
    {
    }

    /**
     * Prevent cloning
     *
     * @return void
     */
    private function __clone()
    {
    }
}
