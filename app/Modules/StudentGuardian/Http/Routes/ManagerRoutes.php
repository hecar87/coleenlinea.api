<?php

use Illuminate\Support\Facades\Route;
use App\Modules\StudentGuardian\Http\Controllers\Manager\StudentGuardianController;


Route::middleware('manager.access')
	->name('school-account.create')
	->post("/school-accounts", [ StudentGuardianController::class, "create" ]);

Route::middleware('manager.access')
	->name('school-account.update')
	->put("/school-accounts", [ StudentGuardianController::class, "update" ]);

Route::middleware('manager.access')
	->name('school-account.delete')
	->delete("/school-accounts/{Id_StudentGuardian}", [ StudentGuardianController::class, "delete" ])
	->where("Id_StudentGuardian", "[0-9]+");

Route::middleware('manager.access')
	->name('school-account.index')
	->get("/school-accounts/{Id_StudentGuardian}", [ StudentGuardianController::class, "index" ])
	->where("Id_StudentGuardian", "[0-9]+");

Route::middleware('manager.access')
	->name('school-account.list')
	->get("/schools/{Id_School}/school-accounts", [ StudentGuardianController::class, "list" ])
	->where("Id_School", "[0-9]+");

Route::middleware('manager.access')
	->name('school-account.search')
	->get("/schools/{Id_School}/school-accounts/search", [ StudentGuardianController::class, "search" ])
	->where("Id_School", "[0-9]+");