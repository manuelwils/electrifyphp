<?php

/*
|----------------------------------------------------------------|
| This file organizes and serves your applcation, you may        |
| want to not edit this file except you know what you're doing   |
|----------------------------------------------------------------|
*/

/**
 * autoload classes
 */
require_once __DIR__ . '/../vendor/autoload.php';

/**
 * load init
 */
require_once __DIR__ . '/../config/init.php';

/**
 * serve routes
 */
require_once __DIR__ . '/../routes/web.php';

/*
|----------------------------------------------------------------|
| All static variables, files and routes will be corrected       |
| with their respected counterpart in next commit                |
|----------------------------------------------------------------|
*/