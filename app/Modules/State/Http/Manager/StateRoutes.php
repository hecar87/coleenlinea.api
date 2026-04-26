<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Manager\State\StateController;


Route::middleware('manager.access')->name('state.create')	->post		("/states",				[ StateController::class, "create" ]);
Route::middleware('manager.access')->name('state.update')	->put		("/states",				[ StateController::class, "update" ]);
Route::middleware('manager.access')->name('state.delete')	->delete	("/states/{Id_State}",	[ StateController::class, "delete" ])->where("Id_State", "[0-9]+");
Route::middleware('manager.access')->name('state.index')	->get		("/states/{Id_State}",	[ StateController::class, "index" ])->where("Id_State", "[0-9]+");
Route::middleware('manager.access')->name('state.list')		->get		("/states",				[ StateController::class, "list" ]);
Route::middleware('manager.access')->name('state.search')	->get		("/states/search",		[ StateController::class, "search" ]);