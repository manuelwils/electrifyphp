<?php

namespace Electrify\Core;

/**
 * @package Validator
 */
class Validator
{
	public function __construct()
	{
		//todo
	}

	/**
	 * email validator
	 * @param string $str
	 * @return bool|int
	 */
	public function is_email($str)
	{
		return (filter_var($str, FILTER_VALIDATE_EMAIL) ? true : false);
	}

	/**
	 * required options validator
	 * @param string $str
	 * @return bool|int 
	 */
	public function is_required($str)
	{
		return (!empty($str) ? true : false);
	}

	/**
	 * check if both string matches
	 * @param string $str1
	 * @param string $str2
	 * @return bool|int 
	 */
	public function match($str1, $str2)
	{
		return ($str1 === $str2 ? true : false);
	}
}
