<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Guardian\Http\Controllers\Manager\GuardianController;


Route::middleware('manager.access')->name('school.create')	->post		("/schools",				[ GuardianController::class, "create" ]);
Route::middleware('manager.access')->name('school.update')	->put		("/schools",				[ GuardianController::class, "update" ]);
Route::middleware('manager.access')->name('school.delete')	->delete	("/schools/{Id_Guardian}",	[ GuardianController::class, "delete" ])->where("Id_Guardian", "[0-9]+");
Route::middleware('manager.access')->name('school.index')	->get		("/schools/{Id_Guardian}",	[ GuardianController::class, "index" ])->where("Id_Guardian", "[0-9]+");
Route::middleware('manager.access')->name('school.list')	->get		("/schools",				[ GuardianController::class, "list" ]);
Route::middleware('manager.access')->name('school.search')	->get		("/schools/search",			[ GuardianController::class, "search" ]);