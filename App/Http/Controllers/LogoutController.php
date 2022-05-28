<?php

namespace App\Http\Controllers;

class LogoutController
{

	public function __construct()
	{
		//todo
	}

	/**
	 * kill login session
	 */
	public static function destroy()
	{

		if (get_session('user_id')) {

			unset($_SESSION['user_id']);

			redirect('./login');
		}
	}
}
