<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Manager\TypeSchool\TypeSchoolController;


Route::middleware('manager.access')->name('type-school.create')	->post		("/type-schools",			[ TypeSchoolController::class, "create" ]);
Route::middleware('manager.access')->name('type-school.update')	->put		("/type-schools",			[ TypeSchoolController::class, "update" ]);
Route::middleware('manager.access')->name('type-school.delete')	->delete	("/type-schools/{Id}",		[ TypeSchoolController::class, "delete" ])->where("Id", "[0-9]+");
Route::middleware('manager.access')->name('type-school.index')	->get		("/type-schools/{Id}",		[ TypeSchoolController::class, "index" ])->where("Id", "[0-9]+");
Route::middleware('manager.access')->name('type-school.list')	->get		("/type-schools",			[ TypeSchoolController::class, "list" ]);
Route::middleware('manager.access')->name('type-school.search')	->get		("/type-schools/search",	[ TypeSchoolController::class, "search" ]);