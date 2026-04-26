<?php

use Illuminate\Support\Facades\Route;
use App\Modules\District\Http\Controllers\Manager\DistrictController;


Route::middleware('manager.access')
	->name('district.create')
	->post(
		"/districts",
		[ DistrictController::class, "create" ]
	);

Route::middleware('manager.access')
	->name('district.update')
	->put(
		"/districts",
		[ DistrictController::class, "update" ]
	);

Route::middleware('manager.access')
	->name('district.delete')
	->delete(
		"/districts/{Id_District}",
		[ DistrictController::class, "delete" ]
	)
	->where("Id_District", "[0-9]+");

Route::middleware('manager.access')
	->name('district.index')
	->get(
		"/districts/{Id_District}",
		[ DistrictController::class, "index" ]
	)
	->where("Id_District", "[0-9]+");

Route::middleware('manager.access')
	->name('district.list')
	->get(
		"/cities/{Id_City}/districts",
		[ DistrictController::class, "list" ]
	)
	->where("Id_City", "[0-9]+");

Route::middleware('manager.access')
	->name('district.search')
	->get(
		"/cities/{Id_City}/districts/search",
		[ DistrictController::class, "search" ]
	)
	->where("Id_City", "[0-9]+");