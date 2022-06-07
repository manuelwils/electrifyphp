<?php

namespace Electrify\Core\Interfaces;

/**
 * An interface for Session and Cookie classes
 * @package SessionCookieInterface
 */

 interface SessionCookieInterface
 {

    /**
     *  initialize session
     */
    public function _init();

    /**
     * @param string $key
     * @param mixed $value
     * @return self
     */
    public function write($key, $value);

    /**
     * @param string $key
     * @return mixed
     */
    public function read($key);

     /**
     * @param string $key
     * @return bool|int
     */
    public function has($key);

    /**
     * clear all sessions
     * @return void
     */
    public function clear();
    
    /**
     * dump sessions
     * @return mixed
     */
    public function dump();

    /**
     * @param string $key
     */
    public function destroy($key);

 }