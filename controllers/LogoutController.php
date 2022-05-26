<?php

class LogoutController {

	public function __construct() {

		//

	}

	public static function kill() {

		if(get_session('user_id')) {

			unset($_SESSION['user_id']);

			redirect('./login');
		}

	}

}