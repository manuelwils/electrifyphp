<?php

namespace App\Core;

use App\Core\Exceptions;
use App\Core\Interfaces\SessionCookieInterface;

/**
 * @package Session
 */
class Session implements SessionCookieInterface
{
    /**
     * Exceptions $exception
     */
    private Exceptions $exception;

    public function __construct()
    {
        $this->exception = new Exceptions;
    }

    /**
     *  initialize session
     */
    public function _init()
    {
        if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return self
     */
    public function write($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * @param string $key
     * @return string
     */
    public function read($key)
    {
        if($this->has($key))
            return $_SESSION[$key];
        $this->exception->log("Session '$key' does not exist");
    }

    /**
     * @param string $key
     * @return bool|int
     */
    public function has($key)
    {
        return array_key_exists($key, $_SESSION);
    }

    /**
     * @return void
     */
    public function clear()
    {
        session_unset();
    }
    
    /**
     * @return mixed
     */
    public function dump()
    {
        return $_SESSION;
    }

    /**
     * @param string $key
     * @return string
     */
    public function destroy($key)
    {
        if($this->has($key)) {
            unset($_SESSION[$key]);
        }
        else {
            $this->exception->log("Session '$key' does not exist");
        }
    }
}