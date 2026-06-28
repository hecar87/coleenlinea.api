<?php

use Illuminate\Support\Facades\Route;
use App\Modules\SchoolYear\Http\Controllers\Manager\SchoolYearController;


Route::middleware('manager.access')
	->name('school-year.create')
	->post("/school-years", [ SchoolYearController::class, "create" ]);

Route::middleware('manager.access')
	->name('school-year.update')
	->put("/school-years", [ SchoolYearController::class, "update" ]);

Route::middleware('manager.access')
	->name('school-year.delete')
	->delete("/school-years/{Id_SchoolYear}", [ SchoolYearController::class, "delete" ])
	->where("Id_SchoolYear", "[0-9]+");

Route::middleware('manager.access')
	->name('school-year.index')
	->get("/school-years/{Id_SchoolYear}", [ SchoolYearController::class, "index" ])
	->where("Id_SchoolYear", "[0-9]+");

Route::middleware('manager.access')
	->name('school-year.list')
	->get("/schools/{Id_School}/school-years", [ SchoolYearController::class, "list" ])
	->where("Id_School", "[0-9]+");

Route::middleware('manager.access')
	->name('school-year.search')
	->get("/schools/{Id_School}/school-years/search", [ SchoolYearController::class, "search" ])
	->where("Id_School", "[0-9]+");