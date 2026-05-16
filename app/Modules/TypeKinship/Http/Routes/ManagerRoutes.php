<?php

use Illuminate\Support\Facades\Route;
use App\Modules\TypeKinship\Http\Controllers\Manager\TypeKinshipController;


Route::middleware('manager.access')->name('type-kinship.create')	->post		("/type-kinships",			[ TypeKinshipController::class, "create" ]);
Route::middleware('manager.access')->name('type-kinship.update')	->put		("/type-kinships",			[ TypeKinshipController::class, "update" ]);
Route::middleware('manager.access')->name('type-kinship.delete')	->delete	("/type-kinships/{Id}",		[ TypeKinshipController::class, "delete" ])->where("Id", "[0-9]+");
Route::middleware('manager.access')->name('type-kinship.index')		->get		("/type-kinships/{Id}",		[ TypeKinshipController::class, "index" ])->where("Id", "[0-9]+");
Route::middleware('manager.access')->name('type-kinship.list')		->get		("/type-kinships",			[ TypeKinshipController::class, "list" ]);
Route::middleware('manager.access')->name('type-kinship.search')	->get		("/type-kinships/search",	[ TypeKinshipController::class, "search" ]);