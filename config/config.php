<?php

// load configuration files

require_once getcwd() . '/env.php';

require_once getcwd() . '/lib/Autoload.php';

require_once getcwd() . '/lib/helpers.php';

DEFINE('SERVER', $env->server);

// set constance for directories
DEFINE('ROOT', getcwd());

DEFINE('LIB' , ROOT . '/lib');

// set constance for environment variables
DEFINE('HOST', $env->dbhost);

DEFINE('DB', $env->dbname);

DEFINE('USER', $env->dbuser);

DEFINE('PASSWORD', $env->dbpass);