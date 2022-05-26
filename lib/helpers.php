<?php

//change 1 to 0 on production
ini_set('display_errors', 1);

/**
 *helper functions for reusable code
*/

// start php session
function start_session() {
	if(session_status() == PHP_SESSION_NONE) {
		session_start();
	}
}
start_session();

// query view directory
function view($path) {

	//views path
	$views_path = getcwd() . '/views/';

	$requested_path = $views_path . $path;

	//check if query path exist in views directory
	try {
		if(file_exists($requested_path)) {

			//return the path
			require_once $requested_path;

			// end script execution
			return;
		}
	} catch(Exception $e) {

		// catch and return any exception
		return $e->getMessage();

	}
	
}

// redirects
function redirect($path) {
	return header('Location: ' . $path);
}


// check not empty value in array
function not_empty($array = array()) {

	foreach($array as $key => $value) {

		if(empty($array[$key])) {

			echo $array[$key] . " cannot be empty";

			return false;

		}

		return true;
	}
}

// load file
function load_file($file, $arg = false): void {

	//if $arg is set to true, then query without the root directory
	if($arg && $arg == false)
		require_once __DIR__ . '/' . $file;
	else
		// query the file from the base directory
		require_once getcwd() . '/' . $file;
}

// query assets directory
function assets($asset) {
	return "public/assets/{$asset}";
}

// get request uri
function get_uri() {
	return $_SERVER['REQUEST_URI'];
}


/**
 * get request methods
 */

// get request
function is_get_request() {
	return ($_SERVER['REQUEST_METHOD'] == 'GET' 
		? true 
		: exit('Only GET request is accepted for this operation!')
	);
}

// get request
function is_post_request() {
	return ($_SERVER['REQUEST_METHOD'] == 'POST' 
		? true 
		: false
	);
}


/**
* working with sessions
*/

// set session 
function set_session($session, $value) {
	return $_SESSION[$session] = $value;
}

// get session
function get_session($session) {
	if(isset($_SESSION[$session])) {
		return $_SESSION[$session];
	} else {
		return false;
	}
}

// cancel further screipt execution
function cancel($msg) {
	exit($msg);
}

// generate random_integer
function rand_session_integers() {
	$random = rand(1, 9).rand(1, 9).rand(1, 9);
	set_session('code', $random);
	echo $random;
}
