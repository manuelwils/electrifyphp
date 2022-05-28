<?php

namespace App\Http\Controllers;

use App\Core\Request;
use App\Models\Login;

class LoginController
{

	public static function index()
	{

		//only guest can view register page
		if (is_auth())
			redirect('./');

		view("auth/login.php");
	}

	public static function auth()
	{

		//only guest can view register page
		if (is_auth())
			return;

		$request = new Request;

		$fields = $request->organize();

		if (Login::attempt($fields)) {
			set_session('user_id', $fields[':email']);
			echo json_encode(array('message' => 'success'));
			return;
		} else {
			echo json_encode(
				array('message' => 'An error occured or invalid login credentials, try again later')
			);
			return;
		}
	}
}
