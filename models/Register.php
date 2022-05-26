<?php 

class Register extends Eloquent
{

	protected $table = 'member';
	protected $fillable = [':first_name', ':last_name', ':display_name', ':email', ':password'];

	public function __construct() {
		new Eloquent($this->table, $this->fillable);
	}

}