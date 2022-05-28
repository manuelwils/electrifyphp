<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config/init.php';

use App\Core\Router;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;

// homepage
Router::get('/', function() {
	HomeController::index();
});

// show register page
Router::get('/register', function() {
	RegisterController::index();
});

// store registration data
Router::post('/store', function() {
	RegisterController::store();
});

// show login form
Router::get('/login', function() {
	LoginController::index();
});

// log in user
Router::post('/auth', function() {
	LoginController::auth();
});

// logout
Router::post('/logout', function() {
	LogoutController::destroy();
});