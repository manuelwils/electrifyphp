<?php
	
	// set enviromental variables
	$env = new stdClass();

	// check runtime environment (can be 'Developement' or 'Production' if deployed)
	$env->type = "Development";

	// set server
	// also change the last line of the .htaccess(line 4) file to point to your server root if not "/mockr"
	$env->server_root = "/mockr";

	// set database host
	$env->dbhost = "localhost";

	// set database name
	$env->dbname = "member";

	// set database username
	$env->dbuser = "root";

	// set database password
	$env->dbpass = "";