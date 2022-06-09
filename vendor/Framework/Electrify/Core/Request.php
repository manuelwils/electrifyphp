<?php

namespace Electrify\Core;

/**
 * @package Request
 */
class Request
{
	/**
	 * request keys
	 */
	private array $keys = [];

	/**
	 * request key value pair
	 */
	public array $data = [];

	/**
	 * errors
	 */
	protected array $errors = [];

	/**
	 * query parameters
	*/
	protected array $routeParams = [];

	/**
	 * Exceptions $exception
	 */
	protected Exceptions $exception;

	public function __construct()
	{
		$this->exception = new Exceptions;
		foreach ($_REQUEST as $key => $value) {
			$this->keys = array_merge($this->keys, array($key));
			$this->data = array_merge($this->data, array(':' . $key => $value));
		}
	}

	/**
	 * get request data
	 * @param string $data
	 */
	public function __get($data)
	{
		return $this->data[':' . $data];
	}

	/**
	 * set request data
	 * @param string $data
	 * @param string $value
	 */
	public function __set($data, $value)
	{
		$this->data[':' . $data] = $value;
	}

	/**
	 * Get request path
	 */
	public function getPath()
	{
		$path = $_SERVER['REQUEST_URI'] ?? '/';
		$position = strpos($path, '?');
		if ($position == false) {
			return $path;
		}
		return substr($path, 0, $position);
	}

	/**
	 * Get request method
	 */
	public function method()
	{
		return strtolower($_SERVER['REQUEST_METHOD']);
	}

	/**
     * @param $params
     * @return self
     */
    public function setParams($params)
    {
        $this->routeParams = $params;
        return $this;
    }

	/**
     * get all params in the route
     */
    public function getParams()
    {
        return $this->routeParams;
    }

	/**
	 * get specific parameter in the route
     * @param string $param
     * @param null $default
     */
    public function getParam($param, $default = null)
    {
        return $this->routeParams[$param] ?? $default;
    }
	
	/**
	 * validate request object
	 * @param array $fields
	 */
	public function validate($fields = [], $sanitize = false)
	{

		/**
		 * bring Validator object to validate request
		 */
		$validator  = new Validator;

		foreach ($fields as $key => $value) {

			if (in_array($key, $this->keys)) {

				/**
				 * check if $value is an array and loop through $value conditions
				 */
				if (is_array($value)) {

					foreach ($value as $condition) {
						switch ($condition) {

							case 'required':
								if (!$validator->is_required($this->data[':' . $key]))
									array_push($this->errors, $key . " is required ");
								break;

							case 'email':
								if (!$validator->is_email($this->data[':' . $key]))
									array_push($this->errors, $key . " must be a valid email ");
								break;

							default:
								// code...

						}
					}
				} else {

					/**
					 * $value is not an array so go through $value conditions
					 */

					switch ($value) {

						case 'required':
							if (!$validator->is_required($this->data[':' . $key]))
								array_push($this->errors, $key . " is required ");
							break;

						case 'email':
							if (!$validator->is_email($this->data[':' . $key]))
								array_push($this->errors, $key . " must be a valid email ");
							break;

						default:
							// code...

					}
				}
			}
		}

		if (count($this->errors) === 0) {
			if($sanitize === true) {
				return $this->sanitize($this->data);
			}
			return $this->data;
		}

		foreach ($this->errors as $error) {
			$this->exception->log($error);
		}

		exit(json_encode(array("message" => $this->errors)));
	}

	/**
	 * organize a Request object
	 */
	public function organize($sanitize = false)
	{
		/**
		 * remove first element of the request object 
		 * [only if the first element is "path", since it's not needed here]
		 */
		if (isset($this->data['path']))
			array_shift($this->data);

		/**
		 * then return request object
		 */
		if($sanitize === true) {
			return $this->sanitize($this->data);
		}
		return $this->data;
	}

	/**
	 * sanitize Request data
	 */
	private function sanitize($data)
	{
		foreach($data as $key => $value) {
			$value = htmlspecialchars($value);
		}
		return $data;
	}
}
