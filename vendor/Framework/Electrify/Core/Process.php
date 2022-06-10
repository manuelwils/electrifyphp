<?php

namespace Electrify\Core;

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
    protected int $port = 8080;

    /**
     * set process directory to listen to
     */
    protected string $path;

    public function __construct($path)
    {
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
        if ($this->windows()) {
            return pclose(popen("start php -S localhost:" . strval($this->port), "r"));
        } else {
            return exec("php -S localhost:" . strval($this->port), " > /dev/null &");
        }
    }

    /**
     * is windows
     */
    private function windows()
    {
        return substr(strtolower(php_uname()), 0, 7) == "windows";
    }
}
