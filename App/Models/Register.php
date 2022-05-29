<?php

namespace App\Models;

use App\Core\Eloquent\Model;

class Register extends Model
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
		new Model($this->table, $this->fillable);
	}
}
