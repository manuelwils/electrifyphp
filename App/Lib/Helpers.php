<?php
/**
 * get authentication
 */
function auth(): Electrify\Core\Eloquent\Authentication
{
	return new Electrify\Core\Eloquent\Authentication;
}

/**
 * Auth session exist
 */
function is_auth(): bool
{
	return auth()->is_auth();
}

/**
 * User is a guest
 */
function is_guest(): bool
{
	return auth()->is_guest();
}

/**
 * query assets directory
 * @param string $asset
 */
function assets($asset): string
{
	return 'http://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . "/assets/{$asset}";
}

/**
 * generate random_integer
 */
function rand_session_integers(): void
{
	$random = rand(1, 9) . rand(1, 9) . rand(1, 9);
	$_SESSION['code'] = $random;
	echo $random;
}

/**
 * @package View extension
 */
function view($view, $layout = "", $params = []) 
{
	return \Electrify\Core\View::render($view, $layout, $params);
}