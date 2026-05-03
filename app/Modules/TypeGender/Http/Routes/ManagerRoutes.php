<?php

use Illuminate\Support\Facades\Route;
use App\Modules\TypeGender\Http\Controllers\Manager\TypeGenderController;


Route::middleware('manager.access')->name('type-gender.create')	->post		("/type-genders",			[ TypeGenderController::class, "create" ]);
Route::middleware('manager.access')->name('type-gender.update')	->put		("/type-genders",			[ TypeGenderController::class, "update" ]);
Route::middleware('manager.access')->name('type-gender.delete')	->delete	("/type-genders/{Id}",		[ TypeGenderController::class, "delete" ])->where("Id", "[0-9]+");
Route::middleware('manager.access')->name('type-gender.index')	->get		("/type-genders/{Id}",		[ TypeGenderController::class, "index" ])->where("Id", "[0-9]+");
Route::middleware('manager.access')->name('type-gender.list')	->get		("/type-genders",			[ TypeGenderController::class, "list" ]);
Route::middleware('manager.access')->name('type-gender.search')	->get		("/type-genders/search",	[ TypeGenderController::class, "search" ]);