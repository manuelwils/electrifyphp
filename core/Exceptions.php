<?php 

/**
 * class Exceptions
 */

class Exceptions 
{

	public Writer $writer;

	public function __construct() {
		$this->writer = new Writer;
	}

	public function log($exception) {
		$this->writer->to('logs.txt')->append($exception);
	}

}