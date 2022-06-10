#!/usr/bin/php
<?php
/**
 * Load packages
 */
require __DIR__ . '/vendor/autoload.php';

use Electrify\Core\Process;

$process = new Process('public');

/**
 * start a dev server
 */
function serve($port = 8080)
{
    global $process;
    $process->listen($port);
}

/**
 * function, arg generator enabler
 */
foreach ($argv as $arg) {
    $parameters = array_slice($argv, 2);
    function_exists($arg) && call_user_func($arg, ...$parameters);
}