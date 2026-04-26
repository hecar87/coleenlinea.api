<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Manager\TypePopulation\TypePopulationController;


Route::middleware('manager.access')->name('type-population.create')	->post		("/type-populations",			[ TypePopulationController::class, "create" ]);
Route::middleware('manager.access')->name('type-population.update')	->put		("/type-populations",			[ TypePopulationController::class, "update" ]);
Route::middleware('manager.access')->name('type-population.delete')	->delete	("/type-populations/{Id}",		[ TypePopulationController::class, "delete" ])->where("Id", "[0-9]+");
Route::middleware('manager.access')->name('type-population.index')	->get		("/type-populations/{Id}",		[ TypePopulationController::class, "index" ])->where("Id", "[0-9]+");
Route::middleware('manager.access')->name('type-population.list')	->get		("/type-populations",			[ TypePopulationController::class, "list" ]);
Route::middleware('manager.access')->name('type-population.search')	->get		("/type-populations/search",	[ TypePopulationController::class, "search" ]);