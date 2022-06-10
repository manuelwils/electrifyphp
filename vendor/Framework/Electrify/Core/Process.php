<?php

namespace Electrify\Core;

use Electrify\Core\Exceptions;
use Electrify\Core\Console\ConsoleKernel;

/**
 * Start shell processes
 * @package Process
 */
class Process extends ConsoleKernel
{
    /**
     * set default port to 8080
     */
    private int $port = 8080;

    /**
     * set process directory to listen to
     */
    private string $path = 'public';

    /**
     * Handle exceptions
     */
    private Exceptions $exception;

    public function __construct($path = '')
    {
        if(isset($path) & !empty($path))
            $this->path = $path;
    }

    /**
     * listen and serve localhost on $port
     * @param int $port
     */
    public function listen($port = null)
    {
        if (isset($port))
            $this->port = $port;

        if ($this->is_windows() && $this->is_valid_path($this->path)) 
        {
            return pclose(popen("start php -S localhost:" . strval($this->port), "r"));
        } 
        else if (!$this->is_windows() && $this->is_valid_path($this->path))
        {
            return exec("php -S localhost:" . strval($this->port), " > /dev/null &");
        }
    }

    /**
     * is windows
     */
    private function is_windows()
    {
        return substr(strtolower(php_uname()), 0, 7) == "windows";
    }

    /**
     * path exist
     */
    private function is_valid_path($path)
    {
        if(file_exists(getcwd() . '/' . $path)) {
            chdir($path); 
            return true;
        } else {
            $this->exception->log("the requested path '$path' for the console program does not exist ");
        }
        return false;
    }
    
}