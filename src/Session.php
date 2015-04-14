<?php

namespace Shopreview;

/**
 * Singleton Class for wrapping session actons
 * 
 * @author Péter Balogh <peter.balogh@theory9.hu>
 * @link https://github.com/ptrblgh/shop-review for source
 * @link http://shop-review.theory9.hu for demo
 */
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
     *
     * @return void
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
     * @return mixed
     */
    public function __set($key, $val)
    {
        return ($_SESSION[$key] = $val);
    }

    /**
     * Destroying session
     * 
     * @return void
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
     *
     * @return void
     */
    public function writeSession()
    {
        session_write_close();
    }

    /**
     * Destructor
     *
     * @return void
     */
    public function __destruct()
    {
        $this->writeSession();
    }
}
