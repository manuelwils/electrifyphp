<?php

namespace Electrify\Core;

use Electrify\Core\View;
use Electrify\Core\Request;
use Electrify\Core\Response;
use Electrify\Core\Exceptions;

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

	/**
	 * Response Module
	 */
	protected Response $response;

	public function __construct()
	{
		$this->view = new View;
		$this->request = new Request;
		$this->response = new Response;
		$this->exception = new Exceptions;
	}

	/**
	 * set get route
	 * @param string $route
	 * @param callback $callback
	 */
	public function get($route, $callback)
	{
		$this->routes['get'][$route] = $callback;
	}

	/**
	 * set post route
	 * @param string $route
	 * @param callback $callback
	 */
	public function post($route, $callback)
	{
		$this->routes['post'][$route] = $callback;
	}
	/**
	 * set put route
	 * @param string $route
	 * @param callback $callback
	 */
	public function put($route, $callback)
	{
		$this->routes['put'][$route] = $callback;
	}
	
	/**
	 * set delete route
	 * @param string $route
	 * @param callback $callback
	 */
	public function delete($route, $callback)
	{
		$this->routes['delete'][$route] = $callback;
	}

	/**
	 * set patch route
	 * @param string $route
	 * @param callback $callback
	 */
	public function patch($route, $callback)
	{
		$this->routes['patch'][$route] = $callback;
	}

	/**
	 * matcho get|post routes
	 * @param string $route
	 * @param callback $callback
	 */
	public function any($route, $callback)
	{
		$this->routes['any'][$route] = $callback;
	}

	/**
	 * get all get|post routes
	 * @param string $method
	 */
	public function getRoutes($method)
	{
		$this->routes[$method] ?? [];
	}

	/**
	 * resolve routes
	 */
	public function resolve()
	{
		$path = $this->request->getPath();
		$method = $this->request->method();
		$callback = $this->routes[$method][$path] ?? false;

		if ($callback == false) {
			$this->exception->log("the requested route '{$path}' does not exist");
			$callback = "404 Not Found!";
			$this->response->setStatusCode(404);
		}
		if (is_string($callback)) {
			return view($callback);
		}
		if (is_array($callback)) {
			$callback[0] = new $callback[0];
		}
		var_dump($callback);
		return call_user_func($callback, $this->request, $this->response);
	}

	/**
	 * Start routing
	 */
	public function run()
	{
		return $this->resolve();
	}
}
