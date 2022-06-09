<?php

namespace App\Http\Controllers;

use Electrify\Core\Request;

class HomeController
{

	public static function index()
	{
		/*
		| -------------------------------------------------------------|
		| rendering index.php inside the main.php(optional) layout and |
		| passing array of data(optional) to the index.php webpage     |
		| -------------------------------------------------------------|
		*/
		view("index", "main", ["title"=>"Homepage"]);
	}

	public function show(Request $request)
	{
		var_dump($request);
	}
}