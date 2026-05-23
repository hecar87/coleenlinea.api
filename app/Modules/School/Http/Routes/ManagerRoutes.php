<?php

use Illuminate\Support\Facades\Route;
use App\Modules\School\Http\Controllers\Manager\SchoolController;


Route::middleware('manager.access')->name('state.create')	->post		("/states",				[ SchoolController::class, "create" ]);
Route::middleware('manager.access')->name('state.update')	->put		("/states",				[ SchoolController::class, "update" ]);
Route::middleware('manager.access')->name('state.delete')	->delete	("/states/{Id_School}",	[ SchoolController::class, "delete" ])->where("Id_School", "[0-9]+");
Route::middleware('manager.access')->name('state.index')	->get		("/states/{Id_School}",	[ SchoolController::class, "index" ])->where("Id_School", "[0-9]+");
Route::middleware('manager.access')->name('state.list')		->get		("/states",				[ SchoolController::class, "list" ]);
Route::middleware('manager.access')->name('state.search')	->get		("/states/search",		[ SchoolController::class, "search" ]);