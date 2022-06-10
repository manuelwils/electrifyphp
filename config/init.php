<?php
/**
 * Ensure PHP version meets requirement for ElectrifyPHP
 */
if(floatval(PHP_VERSION) < 7.4) {
    exit("ElectrifyPHP requires PHP version 7.4.x or higher, found v".floatval(PHP_VERSION).". Upgrade your PHP version to continue");
}

$session = new Electrify\Core\Session;

/**
 * Initialize application session
 */
$session->_init();

/**
 * load dependency files
 */
require_once getcwd() . '/../env.php';
require_once getcwd() . '/../App/Lib/Helpers.php';

/**
 * set constance for directories
 */
DEFINE('ROOT', getcwd());

/**
 * set constance for database object
 */
DEFINE('HOST', $env->dbhost);
DEFINE('DB', $env->dbname);
DEFINE('USER', $env->dbuser);
DEFINE('PASSWORD', $env->dbpass);

/**
 * All items in this section would be moved to it respect config file
 */