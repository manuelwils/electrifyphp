<?php

namespace Electrify\Core\Eloquent;

use Electrify\Core\Exceptions;
use Exception;
use Electrify\Core\Hash;

use Electrify\Core\Eloquent\Database\Database as DB;
use Electrify\Core\Response;
use Electrify\Core\Session;

/**
 * @package Authentication
 */
class Authentication
{
	/**
	 * database table 
	 */
	protected $table;

	/**
	 * required input fields for login 
	 */
	protected $requirements;

	/**
	 * Exceptions $exception
	 */
	protected $exception;

	/**
	 * Session $session
	 */
	protected $session;

	/**
	 * Response $response
	 */
	protected $response;

	/**
	 * @param string $table
	 * @param array $requirements 
	 */
	public function __construct($table = null, $requirements = [])
	{
		$this->exception = new Exceptions;
		$this->table = $table;
		$this->requirements = $requirements;
		$this->session = new Session;
		$this->response = new Response;
	}

	/**
	 * attempt login
	 * @param array $fields
	 */
	public static function attempt($fields = array())
	{
		$self = new static;
		try {
			/**
			 * get database password
			 */
			$old_password = DB::query(
				"SELECT " . ltrim($self->requirements[1], ':') . " FROM " . $self->table . " WHERE " . ltrim($self->requirements[0], ':') . "=:" . ltrim($self->requirements[0], ':') . "",
				array(
					$self->requirements[0] => $fields[$self->requirements[0]],
				)
			)[0][ltrim($self->requirements[1], ':')];

			/**
			 * get database email
			 */
			$email = DB::query(
				"SELECT " . ltrim($self->requirements[0], ':') . " FROM " . $self->table . " WHERE " . ltrim($self->requirements[0], ':') . "=:" . ltrim($self->requirements[0], ':') . "",
				array(
					$self->requirements[0] => $fields[$self->requirements[0]],
				)
			);
		} catch (Exception $e) {
			$self->exception->log($e->getMessage());
			return false;
		}

		/**
		 * check if email and password are correct
		 */
		if (count($email) != 0 && Hash::verify($fields[$self->requirements[1]], $old_password)) {
			return true;
		}

		return false;
	}

	/**
	 * is user logged in?
	 * @return bool|int
	 */
	public function is_auth()
	{
		return ($this->session->has('user_id') ? true : false);
	}

	/**
	 * is user a guest?
	 * @return bool|int
	 */
	public function is_guest()
	{
		return (!$this->session->has('user_id') ? true : false);
	}

	/**
	 * fetch user data
	 * @param string $data
	 */
	public function user($data)
	{
		return (DB::query("SELECT $data FROM member WHERE email=:email", array(':email' => $this->session->read('user_id')))[0][$data]);
	}

	/**
	 * set login session
	 * @param string $name
	 * @param string $value
	 */
	public static function set_session($name, $value)
	{
		$session = new Session;
		$session->write($name, $value);
	}

	/**
	 * logout authenticated session
	 */
	public static function logout()
	{
		$self = new static;
		$self->session->destroy('user_id');
		$self->response->redirect('/login');
	}
}
