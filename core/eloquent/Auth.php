<?php

/**
 * user Authentication class
 */

class Auth {
	
	protected $table;
	protected $requirements;

	public function __construct($table, $requirements) {
		$this->table = $table;
		$this->requirements = $requirements;
	}

	// attempt login
	public static function attempt($fields = array()) {
		$self = new static;
		try {
			$old_password = DB::query("SELECT " . ltrim($self->requirements[1], ':') . " FROM " . $self->table . " WHERE " . ltrim($self->requirements[0], ':') . "=:" . ltrim($self->requirements[0], ':') . "", 
				array(
					$self->requirements[0] => $fields[$self->requirements[0]],
				)
			)[0][ltrim($self->requirements[1], ':')];
		
			$email = DB::query("SELECT " . ltrim($self->requirements[0], ':') . " FROM " . $self->table . " WHERE " . ltrim($self->requirements[0], ':') . "=:" . ltrim($self->requirements[0], ':') . "",
				array(
					$self->requirements[0] => $fields[$self->requirements[0]],
				)
			);
		} catch(Exception $e) {
			return false;
		}
		if(count($email) != 0 && SecureData::verify($fields[$self->requirements[1]], $old_password)) {
			return true;
		}
		
		return false;

	}

	public static function is_auth() {
		return (get_session('user_id') ? true : false);
	}

	public static function is_guest() {
		return (!get_session('user_id') ? true : false);
	}

	public static function user($data) {

		return (DB::query("SELECT $data FROM member WHERE email=:email", array(':email' => get_session('user_id')))[0][$data]);

	}

}