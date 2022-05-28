<?php

class RegisterController 
{

	public static function index() {
		
		//only guest can view register page
		if(!Auth::is_guest()) {
			redirect('./');
		}

		view("auth/register.php");
	}

	public static function store() {

		///only guest can view register page
		if(!Auth::is_guest()) {
			exit();
		}

		$request = new Request;

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
		if(Register::find('email', $request->email)) {
			exit("email already exist");
		}

		// validate captcha
		if($request->captcha !== get_session('code')) {
			exit("captcha does not match");
		}

		// confirm password
		if($request->password !== $request->confirm_password) {
			exit("password not match with password confirmation");
		}

		$request->password = Hash::make($request->password);
		//die(var_dump($request));
		try {
			Register::create($fields);
		} catch(Exception $e) {
			exit($e->getMessage());
		}

		return json_encode(array("message" => "success"));

	}

}