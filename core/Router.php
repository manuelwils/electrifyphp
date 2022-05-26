<?php 

/**
 * Router class
*/

class Router {

	/**
	 * get route
	 * @param string $route
	 * @param callback $callback
	 */
	public static function get($route, $callback) {
		
		// must be a get request
		//is_get_request();

		// get the current request uri/route
		$request_uri = get_uri();

		// check if the request uri match the route we provided
		if($request_uri === SERVER_ROOT . $route) {
			try {
				$callback();
			} catch(Exception $e) {
				return $e->getMessage();
			}

		}

	}

	/**
	 * get route
	 * @param string $route
	 * @param callback $callback
	 */
	public static function post($route, $callback) {
		
		// must be a post request
		if(is_post_request()) {

			// get the current request uri/route
			$request_uri = get_uri();

			// check if the request uri match the route we provided
			if($request_uri === SERVER_ROOT . $route) {
				try {
					$callback();
				} catch(Exception $e) {
					return $e->getMessage();
				}

			}
		}

	}

}