<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Manager\TypeLevel\TypeLevelController;


Route::middleware('manager.access')->name('type-level.create')	->post		("/type-levels",			[ TypeLevelController::class, "create" ]);
Route::middleware('manager.access')->name('type-level.update')	->put		("/type-levels",			[ TypeLevelController::class, "update" ]);
Route::middleware('manager.access')->name('type-level.delete')	->delete	("/type-levels/{Id}",		[ TypeLevelController::class, "delete" ])->where("Id", "[0-9]+");
Route::middleware('manager.access')->name('type-level.index')	->get		("/type-levels/{Id}",		[ TypeLevelController::class, "index" ])->where("Id", "[0-9]+");
Route::middleware('manager.access')->name('type-level.list')	->get		("/type-levels",			[ TypeLevelController::class, "list" ]);
Route::middleware('manager.access')->name('type-level.search')	->get		("/type-levels/search",		[ TypeLevelController::class, "search" ]);