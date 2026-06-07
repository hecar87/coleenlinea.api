<?php

use Illuminate\Support\Facades\Route;
use App\Modules\SchoolLevel\Http\Controllers\Manager\SchoolLevelController;


Route::middleware('manager.access')
	->name('school-account.create')
	->post("/school-accounts", [ SchoolLevelController::class, "create" ]);

Route::middleware('manager.access')
	->name('school-account.update')
	->put("/school-accounts", [ SchoolLevelController::class, "update" ]);

Route::middleware('manager.access')
	->name('school-account.delete')
	->delete("/school-accounts/{Id_SchoolLevel}", [ SchoolLevelController::class, "delete" ])
	->where("Id_SchoolLevel", "[0-9]+");

Route::middleware('manager.access')
	->name('school-account.index')
	->get("/school-accounts/{Id_SchoolLevel}", [ SchoolLevelController::class, "index" ])
	->where("Id_SchoolLevel", "[0-9]+");

Route::middleware('manager.access')
	->name('school-account.list')
	->get("/schools/{Id_School}/school-accounts", [ SchoolLevelController::class, "list" ])
	->where("Id_School", "[0-9]+");

Route::middleware('manager.access')
	->name('school-account.search')
	->get("/schools/{Id_School}/school-accounts/search", [ SchoolLevelController::class, "search" ])
	->where("Id_School", "[0-9]+");