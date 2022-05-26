<?php 

// auto load all classes

function autoload($class_name) {

	// get classes from various directories
	$core = getcwd() . "/core/{$class_name}.php";
	$controllers = getcwd() . "/controllers/{$class_name}.php";
	$models = getcwd() . "/models/{$class_name}.php";
	$config = getcwd() . "/config/{$class_name}.php";
	$eloquent = getcwd() . "/eloquent/{$class_name}.php";

	// check if the class exist and return that class
	// otherwise return an error statement
	if(file_exists($core))
		require_once $core;
	else if(file_exists($controllers))
		require_once $controllers;
	else if(file_exists($models))
		require_once $models;
	else if(file_exists($config))
		require_once $config;
	else if(file_exists($eloquent))
		require_once $eloquent;
	else
		return exit("Class {$class_name} does not exists");

}

// register autoload function
spl_autoload_register("autoload");