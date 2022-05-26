<?php

class LoginController 
{

	public static function index() {
		
		//only guest can view register page
		if(!Auth::is_guest()) {
			redirect('./');
		}

		view("auth/login.php");
	}

	public static function auth() {

		//only guest can view register page
		if(!Auth::is_guest()) {
			exit();
		}

		$fields = array(
			':email' => SecureData::escape_string($_POST['email']),
			':password' => SecureData::escape_string($_POST['password']),
		);

		if(Login::attempt($fields)) {
			set_session('user_id', $fields[':email']);
			echo json_encode(array('message' => 'success'));
			return;
		} else {
			echo json_encode(array('message' => 'An error occured or invalid login credentials, try again later'));
			return;
		}

	}

}