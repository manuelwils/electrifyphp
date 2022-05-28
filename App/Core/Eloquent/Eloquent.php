<?php

namespace App\Core\Eloquent;

/**
 * class Eloquent
 */
class Eloquent
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
	 * @param string $table
	 * @param array $fillable 
	 */
	public function __construct($table, $fillable = [])
	{
		$this->table = $table;
		$this->fillable = $fillable;
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
		DB::query("INSERT INTO " . $this->table . " VALUES(null, " . implode(',', $this->fillable) . ", NOW())", $props);
	}

	/**
	 * check if field exist in database
	 * @param string $selection
	 * @param string $data
	 * @return mixed
	 */
	public function exist($selection, $data)
	{
		$query = DB::query(
			"SELECT $selection FROM " . $this->table . " WHERE $selection=:$selection",
			array(
				":$selection" => $data,
			)
		);
		if (count($query) > 0) {
			return true;
		}
		return false;
	}

	/**
	 * find one data in database table
	 * @param string $selection
	 * @param string $data
	 * @return mixed
	 */
	public function find($data)
	{
		$query = DB::query(
			"SELECT $data FROM " . $this->table
		);
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
		$query = DB::query("SELECT * FROM " . $this->table);
		if (count($query) > 0) {
			return $query;
		}
		return false;
	}
}
