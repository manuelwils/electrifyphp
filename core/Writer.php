<?php

class Writer
{

	private $path;
	private $time_stamp;

	public function __construct() {
		$this->time_stamp = date('d-m-Y H:i:s');
	}

	public function to($file_path) {
		$this->path = $file_path;
		return $this;
	}

	public function write($text) {
		$file = fopen($this->path, 'w');
		if ($file) {
			fwrite($file, "[$this->time_stamp] $text");
			fclose($file);
		} else {
			throw new Exception("Error writing file", 1);	
		}
	}

	public function append($text) {
		$file = fopen($this->path, 'a');
		if ($file) {
			fwrite($file, "\n[$this->time_stamp] $text");
			fclose($file);
		} else {
			throw new Exception("Error writing file", 1);
		}
	}
}