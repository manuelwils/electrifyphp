<?php

namespace Electrify\Core;

/**
 * @package Hash
 */
class Hash
{

	public function __construct()
	{
		//todo
	}

	/**
	 * hash data (e.g password)
	 * @param string $data
	 */
	public static function make($data)
	{
		return password_hash($data, PASSWORD_BCRYPT);
	}

	/**
	 * very data to old storage (e.g password)
	 * @param string $data
	 * @param string $previous_data
	 */
	public static function verify($data, $previous_data)
	{
		return password_verify($data, $previous_data);
	}
}
