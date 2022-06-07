<?php

namespace App\Http\Controllers;

use App\Core\View;
use App\Core\Request;
use App\Models\Login;
use App\Core\Response;
use App\Core\Eloquent\Authentication as Auth;

class LoginController
{

	public static function index($request, Response $response)
	{
		// only guest can view register page
		if (Auth::auth())
			$response->redirect('./');
		View::render("auth/login");
	}

	public static function auth(Request $request)
	{
		// only guest can view register page
		if (Auth::auth())
			return;

		$fields = $request->organize();
		
		if (Login::attempt($fields)) {
			Login::set_session('user_id', $fields[':email']);
			echo json_encode(array('message' => 'success'));
			return;
		} else {
			echo json_encode(array('message' => 'An error occured or invalid login credentials, try again later'));
			return;
		}
	}
}
