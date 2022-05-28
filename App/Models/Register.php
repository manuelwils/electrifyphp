<?php

namespace App\Models;

use App\Core\Eloquent\Eloquent;

class Register extends Eloquent
{
	/**
	 * database table 
	 */
	protected $table = 'member';

	/**
	 * required request input fields for registration 
	 */
	protected $fillable = [':first_name', ':last_name', ':display_name', ':email', ':password'];

	/**
	 * initialize
	 */
	public function __construct()
	{
		new Eloquent($this->table, $this->fillable);
	}
}
