<?php

require_once __DIR__ . '/config/init.php';

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
	LogoutController::kill();
});