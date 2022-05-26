<?php 

class Login extends Auth
{

	protected $table = 'member';
	protected $requirements = [':email', ':password'];

	public function __construct() {
		new Auth($this->table, $this->requirements);
	}

}