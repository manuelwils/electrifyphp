<?php

namespace App\Core;

use App\Core\View;
use App\Core\Request;
use App\Core\Response;
use App\Core\Exceptions;

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
	 * resolve routes
	 */
	public function resolve()
	{
		$path = $this->request->getPath();
		$method = $this->request->getMethod();
		$callback = $this->routes[$method][$path] ?? false;

		if ($callback == false) {
			$this->exception->log("the requested route '{$path}' does not exist");
			$callback = "404 Not Found!";
		}

		if (is_callable($callback)) {
			return call_user_func($callback, $this->request, $this->response);
		}
		echo $callback;
	}

	/**
	 * Start routing
	 */
	public function run()
	{
		return $this->resolve();
	}
}
