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

		$fields = array(
			':first_name' => SecureData::escape_string($_POST['firstname']),
			':last_name' => SecureData::escape_string($_POST['lastname']),
			':display_name' => SecureData::escape_string($_POST['displayname']),
			':email' => SecureData::escape_string($_POST['email']),
			':cap' => SecureData::escape_string($_POST['captcha']),
			':pass' => SecureData::escape_string($_POST['password']),
			':password' => SecureData::hash($_POST['password']),
			':confirm_password' => SecureData::escape_string($_POST['confirmpassword']),
		);

		// ensure no field is empty
		not_empty($fields);

		//check if email already exist
		if(Register::find('email', $fields[':email'])) {
			exit("email already exist");
		}

		// validate email
		if(!filter_var($fields[':email'], FILTER_VALIDATE_EMAIL)) {
			exit("Invalid email");
		}

		// validate captcha
		if($fields[':cap'] !== get_session('code')) {
			exit("captcha does not match");
		}

		// confirm password
		if($fields[':pass'] !== $fields[':confirm_password']) {
			exit("password not match with password confirmation");
		}
		
		try {
			Register::create($fields);
		} catch(Exception $e) {
			exit($e->getMessage());
		}

		return json_encode(array("message" => "success"));

	}

}