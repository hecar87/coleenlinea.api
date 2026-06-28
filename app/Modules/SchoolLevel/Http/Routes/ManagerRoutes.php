<?php

use Illuminate\Support\Facades\Route;
use App\Modules\SchoolLevel\Http\Controllers\Manager\SchoolLevelController;


Route::middleware('manager.access')
	->name('school-level.create')
	->post("/school-levels", [ SchoolLevelController::class, "create" ]);

Route::middleware('manager.access')
	->name('school-level.update')
	->put("/school-levels", [ SchoolLevelController::class, "update" ]);

Route::middleware('manager.access')
	->name('school-level.delete')
	->delete("/school-levels/{Id_SchoolLevel}", [ SchoolLevelController::class, "delete" ])
	->where("Id_SchoolLevel", "[0-9]+");

Route::middleware('manager.access')
	->name('school-level.index')
	->get("/school-levels/{Id_SchoolLevel}", [ SchoolLevelController::class, "index" ])
	->where("Id_SchoolLevel", "[0-9]+");

Route::middleware('manager.access')
	->name('school-level.list')
	->get("/schools/{Id_School}/school-levels", [ SchoolLevelController::class, "list" ])
	->where("Id_School", "[0-9]+");

Route::middleware('manager.access')
	->name('school-level.search')
	->get("/schools/{Id_School}/school-levels/search", [ SchoolLevelController::class, "search" ])
	->where("Id_School", "[0-9]+");