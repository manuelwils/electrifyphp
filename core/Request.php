<?php 

/**
 * Request class
*/

class Request 
{

	public array $keys = [];
	public array $data = [];
	protected array $errors = [];

	// third party class (Composition patten)
	public Exceptions $exception;

	public function __construct() {
		$this->exception = new Exceptions;
		foreach ($_REQUEST as $key => $value) {
			$this->keys = array_merge($this->keys, array($key));
			$this->data = array_merge($this->data, array(':'.$key => $value));
		}
	}

	public function __get($data) {
		return $this->data[':'.$data];
	}

	public function __set($data, $value) {
		$this->data[':'.$data] = $value;
	}

	public function validate($fields = [] ) {

		$validator  = new Validator;

		foreach ($fields as $key => $value) {

			if (in_array($key, $this->keys)) {

				if (is_array($value)) {

					foreach ($value as $condition) {
						switch ($condition) {

							case 'required':
								if(!$validator->is_required($this->data[':'.$key]))
									array_push($this->errors, $key . " is required ");
								break;

							case 'email':
								if(!$validator->is_email($this->data[':'.$key]))
									array_push($this->errors, $key . " must be a valid email ");
								break;
							
							default:
								// code...

						}
					}

				} else {

					switch($value) {

						case 'required':
							if(!$validator->is_required($this->data[':'.$key]))
								array_push($this->errors, $key . " is required ");
							break;

						case 'email':
							if(!$validator->is_email($this->data[':'.$key]))
								array_push($this->errors, $key . " must be a valid email ");
							break;
						
						default:
							// code...

					}

				}

			}

		}

		if (count($this->errors) === 0) {
			return $this->data;
		}

		foreach ($this->errors as $error) {
			$this->exception->log($error);
		}
		
		exit(var_dump($this->errors));

	}

	public function organize() {
		array_shift($this->data);
		return $this->data;
	}

}