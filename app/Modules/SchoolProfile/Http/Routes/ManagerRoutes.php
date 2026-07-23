<?php

use Illuminate\Support\Facades\Route;
use App\Modules\SchoolProfile\Http\Controllers\Manager\SchoolProfileController;


Route::middleware('manager.access')
	->name('school-account.create')
	->post("/school-accounts", [ SchoolProfileController::class, "create" ]);

Route::middleware('manager.access')
	->name('school-account.update')
	->put("/school-accounts", [ SchoolProfileController::class, "update" ]);

Route::middleware('manager.access')
	->name('school-account.delete')
	->delete("/school-accounts/{Id_SchoolProfile}", [ SchoolProfileController::class, "delete" ])
	->where("Id_SchoolProfile", "[0-9]+");

Route::middleware('manager.access')
	->name('school-account.index')
	->get("/school-accounts/{Id_SchoolProfile}", [ SchoolProfileController::class, "index" ])
	->where("Id_SchoolProfile", "[0-9]+");

Route::middleware('manager.access')
	->name('school-account.list')
	->get("/schools/{Id_School}/school-accounts", [ SchoolProfileController::class, "list" ])
	->where("Id_School", "[0-9]+");

Route::middleware('manager.access')
	->name('school-account.search')
	->get("/schools/{Id_School}/school-accounts/search", [ SchoolProfileController::class, "search" ])
	->where("Id_School", "[0-9]+");