<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Charge\Http\Controllers\Manager\ChargeController;


Route::middleware('manager.access')->name('school.create')	->post		("/schools",				[ ChargeController::class, "create" ]);
Route::middleware('manager.access')->name('school.update')	->put		("/schools",				[ ChargeController::class, "update" ]);
Route::middleware('manager.access')->name('school.delete')	->delete	("/schools/{Id_Charge}",	[ ChargeController::class, "delete" ])->where("Id_Charge", "[0-9]+");
Route::middleware('manager.access')->name('school.index')	->get		("/schools/{Id_Charge}",	[ ChargeController::class, "index" ])->where("Id_Charge", "[0-9]+");
Route::middleware('manager.access')->name('school.list')	->get		("/schools",				[ ChargeController::class, "list" ]);
Route::middleware('manager.access')->name('school.search')	->get		("/schools/search",			[ ChargeController::class, "search" ]);