<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::group(
	[
		"namespace" 	=> "App\Http\Controllers\Manager",
		"prefix"		=> "manager"
	],
	function()
	{
		$RouteBase	= __DIR__ . "/../app/Http/Controllers/Manager/";

		//include ( $RouteBase . "State/StateRoutes.php" );
	}
);
