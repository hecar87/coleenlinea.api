<?php

use Illuminate\Support\Facades\Route;
use App\Modules\City\Http\Controllers\Manager\CityController;


Route::middleware('manager.access')->name('city.create')	->post		("/cities",							[ CityController::class, "create" ]);
Route::middleware('manager.access')->name('city.update')	->put		("/cities",							[ CityController::class, "update" ]);
Route::middleware('manager.access')->name('city.delete')	->delete	("/cities/{Id_City}",				[ CityController::class, "delete" ])->where("Id_City", "[0-9]+");
Route::middleware('manager.access')->name('city.index')		->get		("/cities/{Id_City}",				[ CityController::class, "index" ])->where("Id_City", "[0-9]+");
Route::middleware('manager.access')->name('city.list')		->get		("/states/{Id_State}/cities",		[ CityController::class, "list" ])->where("Id_State", "[0-9]+");
Route::middleware('manager.access')->name('city.search')	->get		("/states/{Id_State}/cities/search",[ CityController::class, "search" ])->where("Id_State", "[0-9]+");