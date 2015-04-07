<?php

namespace Shopreview\Mvc;

use Shopreview\Helper\Helper;
use Shopreview\Helper\Session;

class Application
{
    protected $config;

    /**
     * Prevent creating a new instance
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
     */
    private function __wake()
    {
    }

    /**
     * Prevent cloning
     */
    private function __clone()
    {
    }
}
