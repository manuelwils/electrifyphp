<?php

namespace App\Core\Eloquent;

use App\Core\Eloquent\Database as DB;
use App\Core\Exceptions;
use Exception;

/**
 * @package Model
 */
class Model
{
	/**
	 * database table 
	 */
	protected $table;

	/**
	 * required input fields for login 
	 */
	protected $fillable;

	/**
	 * Exceptions $exception 
	 */
	private $exception;

	/**
	 * @param string $table
	 * @param array $fillable 
	 */
	public function __construct($table, $fillable = [])
	{
		$this->table = $table;
		$this->fillable = $fillable;
		$this->exception = new Exceptions;
	}

	/**
	 * create a user
	 * @param array $fields
	 */
	public function create($fields = array())
	{
		$props = array();
		for ($i = 0; $i < count($this->fillable); $i++) {
			$props = array_merge($props, array($this->fillable[$i] => $fields[$this->fillable[$i]]));
		}
		try {
			DB::query("INSERT INTO " . $this->table . " VALUES(null, " . implode(',', $this->fillable) . ", NOW())", $props);
		} catch(Exception $e){
			$this->exception->log($e->getMessage());
		}
	}

	/**
	 * check if field exist in database
	 * @param string $selection
	 * @param string $data
	 * @return mixed
	 */
	public function exist($selection, $data)
	{
		try {
			$query = DB::query("SELECT $selection FROM " . $this->table . " WHERE $selection=:$selection",
				array(":$selection" => $data));
		} catch(Exception $e){
			$this->exception->log($e->getMessage());
		}

		if (count($query) > 0) {
			return true;
		}
		return false;
	}

	/**
	 * find one data in database table
	 * @param string $data
	 * @return mixed
	 */
	public function find($data)
	{
		try {
			$query = DB::query("SELECT $data FROM " . $this->table);
		} catch(Exception $e){
			$this->exception->log($e->getMessage());
		}

		if (count($query) > 0) {
			return $query;
		}
		return false;
	}

	/**
	 * find data in database tablen with condition
	 * @param string $data
	 * @param string $key
	 * @param mixed $value
	 * @return mixed
	 */
	public function findWhere($data, $key, $value)
	{
		try {
			$query = DB::query("SELECT $data FROM" . $this->table . "WHERE $key=:$key", array(":$key" => $value))[0][$data];
		} catch(Exception $e){
			$this->exception->log($e->getMessage());
		}

		if (count($query) > 0) {
			return $query;
		}
		return false;
	}

	/**
	 * find all data in a table
	 * @return mixed
	 */ 
	public function findAll()
	{
		try {
			$query = DB::query("SELECT * FROM " . $this->table);
		} catch(Exception $e){
			$this->exception->log($e->getMessage());
		}

		if (count($query) > 0) {
			return $query;
		}
		return false;
	}
}
