<?php

namespace App\Core;

use App\Core\Exceptions;
use App\Core\Interfaces\SessionCookieInterface;

/**
 * @package Session
 */
class Cookie implements SessionCookieInterface
{
    /**
     * Exceptions $exception
     */
    private $exception;

    public function __construct()
    {
        $this->exception = new Exceptions;
    }

    /**
     *  initialize cookie
     */
    public function _init()
    {
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return self
     */
    public function write($key, $value)
    {
    }

    /**
     * @param string $key
     * @return string
     */
    public function read($key)
    {
    }

    /**
     * @param string $key
     * @return bool|int
     */
    public function has($key)
    {
    }

    /**
     * @return void
     */
    public function clear()
    {
    }
    
    /**
     * @return mixed
     */
    public function dump()
    {
    }

    /**
     * @param string $key
     * @return string
     */
    public function destroy($key)
    {
    }
}