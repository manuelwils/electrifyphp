<?php

namespace App\Core;

use Exception;

/**
 * class Writer
 */

class Writer
{

	/**
	 * path to write file to
	 */
	private $path;

	/**
	 * time stamp 
	 */
	private $time_stamp;

	public function __construct()
	{
		$this->time_stamp = date('d-m-Y H:i:s');
	}

	/**
	 * write file to
	 * @param string $file_path
	 */
	public function to($file_path)
	{
		$this->path = $file_path;
		return $this;
	}

	/**
	 * write $text to $path
	 * @param string $text
	 */
	public function write($text)
	{
		$file = fopen($this->path, 'w');
		if ($file) {
			fwrite($file, "[$this->time_stamp] $text");
			fclose($file);
		} else {
			throw new Exception("Error writing file", 1);
		}
	}

	/**
	 * append $text to $path
	 * @param string $text
	 */
	public function append($text)
	{
		$file = fopen($this->path, 'a');
		if ($file) {
			fwrite($file, "\n[$this->time_stamp] $text");
			fclose($file);
		} else {
			throw new Exception("Error writing file", 1);
		}
	}
	
}
