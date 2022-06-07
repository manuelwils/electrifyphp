<?php

namespace Mockr\Http\Controllers;

use Exception;
use Electrify\Core\Hash;
use Electrify\Core\View;
use Electrify\Core\Request;
use Electrify\Core\Response;
use Electrify\Core\Exceptions;
use Mockr\Models\Register;
use Electrify\Core\Eloquent\Authentication as Auth;
use Electrify\Core\Session;

class RegisterController
{

	public static function index($request, Response $response)
	{
		//only guest can view register page
		if (Auth::auth())
			$response->redirect('./');
		View::render("auth/register", "main");
	}

	public static function store(Request $request)
	{
		// only guest can view register page
		if (Auth::auth())
			return;

		$register = new Register;
		$exception = new Exceptions;
		$session = new Session;

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