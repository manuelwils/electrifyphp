<?php 

/**
 * class Validator
 */

class Validator
{
	public function __construct() {
		//todo
	}

	public function is_email($str) {
		return (filter_var($str, FILTER_VALIDATE_EMAIL) ? true : false);
	}

	public function is_required($str) {
		return (!empty($str) ? true : false);
	}

	public function match($str1, $str2) {
		return ($str === $str2 ? true : false);
	}

}