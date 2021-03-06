<?php

namespace Electrify\Core;

/**
 * @package Exceptions
 */
class Exceptions
{
	/**
	 * @param Exceptions $exception
	 */
	public Writer $writer;

	public function __construct()
	{
		$this->writer = new Writer;
	}

	/**
	 * log exception
	 * log.txt is statically typed here, would be change to $_env['log']
	 * @param string $exception
	 */
	public function log($exception)
	{
		$this->writer->to('runtime/logs.txt')->append($exception);
	}
}
