<?php

namespace App\Http\Controllers;

use Exception;
use Electrify\Core\Hash;
use Electrify\Core\Request;
use Electrify\Core\Response;
use Electrify\Core\Exceptions;
use App\Models\Register;
use Electrify\Core\Session;

class RegisterController
{

	public function index($request, Response $response)
	{
		//only guest can view register page
		if (is_auth())
			$response->redirect('./');
		view("auth/register", "main");
	}

	public function store(Request $request)
	{
		// only guest can view register page
		if (is_auth())
			return;

		$register = new Register;
		$exception = new Exceptions;
		$session = new Session;

		/*
		|-------------------------------------------------------------------|
		| you can optionally pass boolean "true" as second argument         |
		| to the $request->validate method to sanitize the request data     |
		|-------------------------------------------------------------------|
		 */
		$fields = $request->validate([
			'first_name' => 'required',
			'last_name' => 'required',
			'display_name' => 'required',
			'email' => ['required', 'email'],
			'captcha' => 'required',
			'password' => 'required',
			'confirm_password' => 'required'
		]);

		// check if email already exist
		if ($register->exist('email', $request->email)) {
			echo json_encode(["message" => "email already exist"]);
			return;
		}

		// validate captcha
		if ($request->captcha !== $session->read('code')) {
			echo json_encode(["message" => "captcha does not match"]);
			return;
		}

		// confirm password
		if ($request->password !== $request->confirm_password) {
			echo json_encode(["message" => "password not match with password confirmation"]);
			return;
		}

		$fields[':password'] = Hash::make($request->password);

		try {
			$register->create($fields);
		} catch (Exception $e) {
			$exception->log($e->getMessage());
			echo json_encode(["message" => $e->getMessage()]);
		}
	}
}