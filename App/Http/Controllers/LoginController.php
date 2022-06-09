<?php

namespace App\Http\Controllers;

use Electrify\Core\Request;
use App\Models\Login;
use Electrify\Core\Response;

class LoginController
{

	public function index($request, Response $response)
	{
		// only guest can view register page
		if (is_auth())
			$response->redirect('./');
		view("auth/login", "main");
	}

	public function auth(Request $request)
	{
		// only guest can view register page
		if (is_auth())
			return;

		/*
		|-------------------------------------------------------------------|
		| you can optionally pass boolean "true" as second argument         |
		| to the $request->organize method to sanitize the request data     |
		|-------------------------------------------------------------------|
		 */
		$fields = $request->organize(true);
		
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
