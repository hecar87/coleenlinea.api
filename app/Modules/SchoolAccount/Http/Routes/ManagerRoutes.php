<?php

use Illuminate\Support\Facades\Route;
use App\Modules\SchoolAccount\Http\Controllers\Manager\SchoolAccountController;


Route::middleware('manager.access')->name('state.create')	->post		("/states",				[ SchoolAccountController::class, "create" ]);
Route::middleware('manager.access')->name('state.update')	->put		("/states",				[ SchoolAccountController::class, "update" ]);
Route::middleware('manager.access')->name('state.delete')	->delete	("/states/{Id_SchoolAccount}",	[ SchoolAccountController::class, "delete" ])->where("Id_SchoolAccount", "[0-9]+");
Route::middleware('manager.access')->name('state.index')	->get		("/states/{Id_SchoolAccount}",	[ SchoolAccountController::class, "index" ])->where("Id_SchoolAccount", "[0-9]+");
Route::middleware('manager.access')->name('state.list')		->get		("/states",				[ SchoolAccountController::class, "list" ]);
Route::middleware('manager.access')->name('state.search')	->get		("/states/search",		[ SchoolAccountController::class, "search" ]);