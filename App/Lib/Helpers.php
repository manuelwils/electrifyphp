<?php

/**
 * change '1' and 'E_ALL' to '0' on production
 */
ini_set('display_errors', 1);
error_reporting(E_ALL);

/**
 * start php session
 */
function start_session()
{
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
}
start_session();

/**
 * query view directory
 * @param string $path
 */
function view($path)
{
	/**
	 * views path
	 */
	$views_path = getcwd() . '/resource/views/';

	/**
	 * path navigated
	 */
	$requested_path = $views_path . $path;

	/**
	 * check if query path exist in views directory
	 */
	if (file_exists($requested_path)) {

		/**
		 * return the path
		 */
		require_once $requested_path;

		/* end script execution */
		return;
	}
}

/**
 * expose authentication
 */
function auth()
{
	return new App\Core\Eloquent\Authentication;
}

/**
 * Auth session exist
 */
function is_auth()
{
	return auth()->is_auth();
}

/**
 * User is a guest
 */
function is_guest()
{
	return auth()->is_guest();
}

/**
 * return encoded data
 * @param string $name
 * @param string $value
 */
function encode($name, $value)
{
	return json_encode(array($name => $value));
}

/**
 * redirects
 * @param string $path
 */
function redirect($path)
{
	return header('Location: ' . $path);
}

/**
 * sanitize data
 * @param string $str
 */
function sanitize($str)
{
	return htmlspecialchars($str);
}

/**
 * load file
 * @param string $file
 */
function load_file($file): void
{
	/**
	 * query the file from the base directory
	 */
	require_once getcwd() . '/' . $file;
}

/**
 * query assets directory
 * @param string $asset
 */
function assets($asset)
{
	return "public/assets/{$asset}";
}

/**
 * get request uri
 */
function get_uri()
{
	return $_SERVER['REQUEST_URI'];
}

/**
 * is get request method
 */
function is_get_request()
{
	return ($_SERVER['REQUEST_METHOD'] == 'GET'
		? true
		: false
	);
}

/**
 * is post request method
 */
function is_post_request()
{
	return ($_SERVER['REQUEST_METHOD'] == 'POST'
		? true
		: false
	);
}

/**
 * set sessions
 * @param string $session
 * @param string $value
 */
function set_session($session, $value)
{
	return $_SESSION[$session] = $value;
}

/**
 * get sessions
 * @param string $session
 */
function get_session($session)
{
	if (isset($_SESSION[$session])) {
		return $_SESSION[$session];
	} else {
		return false;
	}
}

/**
 * cancel further script execution
 * @param string $msg
 */
function cancel($msg)
{
	throw new Exception($msg);
}

/**
 * generate random_integer
 */
function rand_session_integers()
{
	$random = rand(1, 9) . rand(1, 9) . rand(1, 9);
	set_session('code', $random);
	echo $random;
}
