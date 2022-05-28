<?php

namespace App\Http\Controllers;

use Exception;
use App\Core\Hash;
use App\Core\Request;
use App\Core\Exceptions;
use App\Models\Register;

class RegisterController
{

	public static function index()
	{

		//only guest can view register page
		if (is_auth())
			redirect('./');

		view("auth/register.php");
	}

	public static function store()
	{

		///only guest can view register page
		if (is_auth())
			return;

		$request = new Request;
		$register = new Register;
		$exception = new Exceptions;

		$fields = $request->validate([
			'first_name' => 'required',
			'last_name' => 'required',
			'display_name' => 'required',
			'email' => ['required', 'email'],
			'captcha' => 'required',
			'password' => 'required',
			'confirm_password' => 'required'
		]);

		//check if email already exist
		if ($register->exist('email', $request->email)) {
			echo encode("message", "email already exist");
			return;
		}

		// validate captcha
		if ($request->captcha !== get_session('code')) {
			echo encode("message", "captcha does not match");
			return;
		}

		// confirm password
		if ($request->password !== $request->confirm_password) {
			echo encode("message", "password not match with password confirmation");
			return;
		}

		$fields[':password'] = Hash::make($request->password);

		try {
			$register->create($fields);
		} catch (Exception $e) {
			$exception->log($e->getMessage());
			echo encode("message", $e->getMessage());
		}
	}
}