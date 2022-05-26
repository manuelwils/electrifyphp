<?php 

/**
* security functions class
*/

class SecureData {

	// escape user inputs and other data
	public static function escape_string($str) {
		return htmlspecialchars($str);
	}

	// hash data (e.g password)
	public static function hash($data) {
		return password_hash($data, PASSWORD_BCRYPT);
	}

	// verify previously hashed data
	public static function verify($data, $previous_data) {
		return password_verify($data, $previous_data);
	}

	// abort when page not found with 404
	public static function abort() {
		return header("HTTP/1.1 404 Not Found");
	}

}