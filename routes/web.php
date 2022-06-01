<?php

use App\Core\Router;
use App\Core\Eloquent\Authentication as Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

/**
 * Instantiate Router
 */
$router = new Router;


// homepage
$router->get('/', function() {
	HomeController::index();
});

// show register page
$router->get('/register', function() {
	RegisterController::index();
});

// store registration data
$router->post('/store', function() {
	RegisterController::store();
});

// show login form
$router->get('/login', function() {
	LoginController::index();
});

// log in user
$router->post('/auth', function() {
	LoginController::auth();
});

// logout
$router->post('/logout', function() {
	Auth::destroy();
});


/**
 * Start routing
 */
$router->run();