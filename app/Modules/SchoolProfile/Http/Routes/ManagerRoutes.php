<?php

use Illuminate\Support\Facades\Route;
use App\Modules\SchoolProfile\Http\Controllers\Manager\SchoolProfileController;


Route::middleware('manager.access')
	->name('school-profile.create')
	->post("/school-profiles", [ SchoolProfileController::class, "create" ]);

Route::middleware('manager.access')
	->name('school-profile.update')
	->put("/school-profiles", [ SchoolProfileController::class, "update" ]);

Route::middleware('manager.access')
	->name('school-profile.delete')
	->delete("/school-profiles/{Id_SchoolProfile}", [ SchoolProfileController::class, "delete" ])
	->where("Id_SchoolProfile", "[0-9]+");

Route::middleware('manager.access')
	->name('school-profile.index')
	->get("/school-profiles/{Id_SchoolProfile}", [ SchoolProfileController::class, "index" ])
	->where("Id_SchoolProfile", "[0-9]+");

Route::middleware('manager.access')
	->name('school-profile.list')
	->get("/schools/{Id_School}/school-profiles", [ SchoolProfileController::class, "list" ])
	->where("Id_School", "[0-9]+");

Route::middleware('manager.access')
	->name('school-profile.search')
	->get("/schools/{Id_School}/school-profiles/search", [ SchoolProfileController::class, "search" ])
	->where("Id_School", "[0-9]+");