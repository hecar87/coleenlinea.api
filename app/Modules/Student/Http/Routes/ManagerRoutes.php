<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Student\Http\Controllers\Manager\StudentController;


Route::middleware('manager.access')->name('school.create')	->post		("/schools",				[ StudentController::class, "create" ]);
Route::middleware('manager.access')->name('school.update')	->put		("/schools",				[ StudentController::class, "update" ]);
Route::middleware('manager.access')->name('school.delete')	->delete	("/schools/{Id_Student}",	[ StudentController::class, "delete" ])->where("Id_Student", "[0-9]+");
Route::middleware('manager.access')->name('school.index')	->get		("/schools/{Id_Student}",	[ StudentController::class, "index" ])->where("Id_Student", "[0-9]+");
Route::middleware('manager.access')->name('school.list')	->get		("/schools",				[ StudentController::class, "list" ]);
Route::middleware('manager.access')->name('school.search')	->get		("/schools/search",			[ StudentController::class, "search" ]);