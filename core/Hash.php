<?php 

/**
* class Hash
* for encryptions
*/

class Hash 
{

	public function __construct() {
		//todo
	}

	// hash data (e.g password)
	public static function make($data) {
		return password_hash($data, PASSWORD_BCRYPT);
	}

	// verify previously hashed data
	public static function verify($data, $previous_data) {
		return password_verify($data, $previous_data);
	}

}