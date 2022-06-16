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
		return $this->routes[$method] ?? [];
	}

	public function getCallback()
    {
        $method = $this->request->method();
        $path = $this->request->getPath();

        /** 
		 * Trim slashes 
		 */
        $path = trim($path, '/');

        /**
		 * Get all routes for current request method 
		 */
        $routes = $this->getRoutes($method);

        $routeParams = false;

        /**
		 * Start iterating registed routes
		 */
        foreach($routes as $route => $callback) {
            /**
			 * Trim slashes
			 */
            $route = trim($route, '/');
            $routeNames = [];

            if (!$route)
                continue;

            /**
			 * Find all route names from route and save in $routeNames
			 */
            if (preg_match_all('/\{(\w+)(:[^}]+)?}/', $route, $matches))
                $routeNames = $matches[1];

            /**
			 * Convert route name into regex pattern
			 */
            $routeRegex = "@^" . preg_replace_callback('/\{\w+(:([^}]+))?}/', fn($m) => isset($m[2]) ? "({$m[2]})" : '(\w+)', $route) . "$@";

            /**
			 * Test and match current route against $routeRegex
			 */
            if (preg_match_all($routeRegex, $path, $valueMatches)) {
                $values = [];
                for ($i = 1; $i < count($valueMatches); $i++) {
                    $values[] = $valueMatches[$i][0];
                }
                $routeParams = array_combine($routeNames, $values);

                $this->request->setParams($routeParams);
                return $callback;
            }
        }

        return false;
    }

	/**
	 * resolve routes
	 */
	public function resolve()
	{
		$path = $this->request->getPath();
		$method = $this->request->method();
		$callback = $this->routes[$method][$path] ?? false;

		if (!$callback) {
            $callback = $this->getCallback();
            if ($callback === false) {
				$this->exception->log("the requested route '{$path}' does not exist");
				echo "404 Not Found!";
				return $this->response->setStatusCode(404);
            }
        }

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
