<?php

use Illuminate\Support\Facades\Route;
use App\Modules\TypeCivil\Http\Controllers\Manager\TypeCivilController;


Route::middleware('manager.access')->name('type-civil.create')	->post		("/type-civils",			[ TypeCivilController::class, "create" ]);
Route::middleware('manager.access')->name('type-civil.update')	->put		("/type-civils",			[ TypeCivilController::class, "update" ]);
Route::middleware('manager.access')->name('type-civil.delete')	->delete	("/type-civils/{Id}",		[ TypeCivilController::class, "delete" ])->where("Id", "[0-9]+");
Route::middleware('manager.access')->name('type-civil.index')	->get		("/type-civils/{Id}",		[ TypeCivilController::class, "index" ])->where("Id", "[0-9]+");
Route::middleware('manager.access')->name('type-civil.list')	->get		("/type-civils",			[ TypeCivilController::class, "list" ]);
Route::middleware('manager.access')->name('type-civil.search')	->get		("/type-civils/search",		[ TypeCivilController::class, "search" ]);