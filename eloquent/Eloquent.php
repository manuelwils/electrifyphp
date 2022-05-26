<?php 

class Eloquent {

	protected $table;
	protected $fillable;

	public function __construct($table, $fillable) {
		$this->table = $table;
		$this->fillable = $fillable;
	}

	//create a user
	public static function create($fields = array()) {
		$self = new static;
		$props = array();
		for($i = 0; $i < count($self->fillable); $i++) {
			$props = array_merge($props, array($self->fillable[$i] => $fields[$self->fillable[$i]]));
		}
		DB::query("INSERT INTO " . $self->table . " VALUES(null, " . implode(',', $self->fillable) . ", NOW())", $props);
	}

	// find one data in database table
	public static function find($selection, $data) {
		$self = new static;
		$query = DB::query("SELECT $selection FROM " . $self->table . " WHERE $selection=:$selection",
			array(
				":$selection" => $data,
			)
		);
		if(count($query) > 0) {
			return true;
		}
		return false;
	}

	// find all data in a table
	public static function findAll() {
		$self = new static;
		$query = DB::query("SELECT * FROM " . $self->table);
		if(count($query) > 0) {
			return true;
		}
		return false;
	}

}