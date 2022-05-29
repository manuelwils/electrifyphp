<?php

namespace App\Models;

use App\Core\Eloquent\Authentication as Auth;

class Login extends Auth
{
	/**
	 * database table 
	 */
	protected $table = 'member';

	/**
	 * required request input fields for login 
	 */
	protected $requirements = [':email', ':password'];

	/**
	 * initialize
	 */
	public function __construct()
	{
		new Auth($this->table, $this->requirements);
	}
}
