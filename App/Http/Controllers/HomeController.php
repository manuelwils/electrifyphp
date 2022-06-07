<?php

namespace App\Http\Controllers;

use App\Core\Eloquent\Authentication;
use App\Core\View;

class HomeController
{

	public static function index()
	{
		View::render("index", ["title"=>"Homepage"]);
	}
}