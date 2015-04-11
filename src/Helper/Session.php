<?php

namespace Shopreview\Helper;


class Session
{
    /**
     * PHP assigned session ID
     * 
     * @var string
     */
    public static $sessionId;

    /**
     * These elements will not be purged upon destroy
     * 
     * @var array
     */
    protected $exclude = array('form_errors');

    /**
     * Prevent creating a new instance
     */
    protected function __construct()
    {
    }

    /**
     * Create the singleton instance
     * 
     * @return object singleton
     */
    public static function getInstance()
    {
        static $instance = null;

        if (null === $instance) {
            session_start();
            self::$sessionId = session_id();
            
            $instance = new static();
        }

        return $instance;
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

    /**
     * Return requested session variable
     * 
     * @param string $key
     * @return mixed
     */
    public function __get($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
    }

    /**
     * Set requested session variable
     * 
     * @param string $key
     * @param mixed $val
     */
    public function __set($key, $val)
    {
        return ($_SESSION[$key] = $val);
    }

    /**
     * Destroying session
     */
    public function destroy()
    {
        foreach ($_SESSION as $key => $val) {
            if (!in_array($key, $this->exclude)) {
                $_SESSION[$key] = null;
            }
        }

        //session_destroy();
    }

    /**
     * Writes the current session
     */
    public function writeSession()
    {
        session_write_close();
    }

    /**
     * Destructor
     */
    public function __destruct()
    {
        $this->writeSession();
    }
}

