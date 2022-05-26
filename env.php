<?php
	
	// set enviromental variables

	$env = new stdClass();

	// check runtime environment (can be 'Developement' or 'Production' if deployed)
	$env->type = "Development";

	// set server
	$env->server_root = "/eka";

	// set database host
	$env->dbhost = "localhost";

	// set database name
	$env->dbname = "member";

	// set database username
	$env->dbuser = "root";

	// set database password
	$env->dbpass = "";