<?php

namespace App\Core;

/**
 * @package Router
 */
class Router
{
	/**
	 * routes
	 */
	protected array $routes = [];

	/**
	 * use Exceptions
	 */
	protected Exceptions $exception;

	/**
	 * Request Module
	 */
	protected Request $request;

	public function __construct()
	{
		$this->request = new Request;
	}

	/**
	 * get route
	 * @param string $route
	 * @param callback $callback
	 */
	public function get($route, $callback)
	{
		$this->routes['get'][$route] = $callback;
	}

	/**
	 * get route
	 * @param string $route
	 * @param callback $callback
	 */
	public function post($route, $callback)
	{

		$this->routes['post'][$route] = $callback;
	}

	/**
	 * resolve routes
	 */
	public function resolve()
	{
		$path = $this->request->getPath();
		$method = $this->request->getMethod();
		$callback = $this->routes[$method][$path];
		
		/*if(!in_array($path, $this->routes['get']) || !in_array($path, $this->routes['post'])) {
			$this->exception->log("the requested route '{$path}' does not exist");
			exit("404 Not Found!");
		}*/

		if (is_callable($callback))
			return call_user_func($callback);
		return $callback;
	}

	/**
	 * Start routing
	 */
	public function run()
	{
		return $this->resolve();
	}
}
