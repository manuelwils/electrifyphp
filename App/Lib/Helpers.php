<?php

/**
 * get authentication
 */
function auth(): App\Core\Eloquent\Authentication
{
	return new App\Core\Eloquent\Authentication;
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
	return 'http://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . "/public/assets/{$asset}";
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