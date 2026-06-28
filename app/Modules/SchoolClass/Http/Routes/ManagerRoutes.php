<?php

use Illuminate\Support\Facades\Route;
use App\Modules\SchoolClass\Http\Controllers\Manager\SchoolClassController;


Route::middleware('manager.access')
	->name('school-class.create')
	->post("/school-classes", [ SchoolClassController::class, "create" ]);

Route::middleware('manager.access')
	->name('school-class.update')
	->put("/school-classes", [ SchoolClassController::class, "update" ]);

Route::middleware('manager.access')
	->name('school-class.delete')
	->delete("/school-classes/{Id_SchoolClass}", [ SchoolClassController::class, "delete" ])
	->where("Id_SchoolClass", "[0-9]+");

Route::middleware('manager.access')
	->name('school-class.index')
	->get("/school-classes/{Id_SchoolClass}", [ SchoolClassController::class, "index" ])
	->where("Id_SchoolClass", "[0-9]+");

Route::middleware('manager.access')
	->name('school-class.list')
	->get("/schools/{Id_School}/school-classes", [ SchoolClassController::class, "list" ])
	->where("Id_School", "[0-9]+");

Route::middleware('manager.access')
	->name('school-class.search')
	->get("/schools/{Id_School}/school-classes/search", [ SchoolClassController::class, "search" ])
	->where("Id_School", "[0-9]+");