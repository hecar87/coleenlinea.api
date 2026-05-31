<?php

use Illuminate\Support\Facades\Route;
use App\Modules\SchoolAccount\Http\Controllers\Manager\SchoolAccountController;


Route::middleware('manager.access')
	->name('school-account.create')
	->post("/school-accounts", [ SchoolAccountController::class, "create" ]);

Route::middleware('manager.access')
	->name('school-account.update')
	->put("/school-accounts", [ SchoolAccountController::class, "update" ]);

Route::middleware('manager.access')
	->name('school-account.delete')
	->delete("/school-accounts/{Id_SchoolAccount}", [ SchoolAccountController::class, "delete" ])
	->where("Id_SchoolAccount", "[0-9]+");

Route::middleware('manager.access')
	->name('school-account.index')
	->get("/school-accounts/{Id_SchoolAccount}", [ SchoolAccountController::class, "index" ])
	->where("Id_SchoolAccount", "[0-9]+");

Route::middleware('manager.access')
	->name('school-account.list')
	->get("/schools/{Id_School}/school-accounts", [ SchoolAccountController::class, "list" ])
	->where("Id_School", "[0-9]+");

Route::middleware('manager.access')
	->name('school-account.search')
	->get("/schools/{Id_School}/school-accounts/search", [ SchoolAccountController::class, "search" ])
	->where("Id_School", "[0-9]+");