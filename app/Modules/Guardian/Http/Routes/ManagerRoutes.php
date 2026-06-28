<?php

use Illuminate\Support\Facades\Route;
use App\Modules\School\Http\Controllers\Manager\SchoolController;


Route::middleware('manager.access')->name('school.create')	->post		("/schools",				[ SchoolController::class, "create" ]);
Route::middleware('manager.access')->name('school.update')	->put		("/schools",				[ SchoolController::class, "update" ]);
Route::middleware('manager.access')->name('school.delete')	->delete	("/schools/{Id_School}",	[ SchoolController::class, "delete" ])->where("Id_School", "[0-9]+");
Route::middleware('manager.access')->name('school.index')	->get		("/schools/{Id_School}",	[ SchoolController::class, "index" ])->where("Id_School", "[0-9]+");
Route::middleware('manager.access')->name('school.list')	->get		("/schools",				[ SchoolController::class, "list" ]);
Route::middleware('manager.access')->name('school.search')	->get		("/schools/search",			[ SchoolController::class, "search" ]);