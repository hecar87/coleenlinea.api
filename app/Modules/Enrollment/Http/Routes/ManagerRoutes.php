<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Enrollment\Http\Controllers\Manager\EnrollmentController;


Route::middleware('manager.access')
	->name('school-account.create')
	->post("/school-accounts", [ EnrollmentController::class, "create" ]);

Route::middleware('manager.access')
	->name('school-account.update')
	->put("/school-accounts", [ EnrollmentController::class, "update" ]);

Route::middleware('manager.access')
	->name('school-account.delete')
	->delete("/school-accounts/{Id_Enrollment}", [ EnrollmentController::class, "delete" ])
	->where("Id_Enrollment", "[0-9]+");

Route::middleware('manager.access')
	->name('school-account.index')
	->get("/school-accounts/{Id_Enrollment}", [ EnrollmentController::class, "index" ])
	->where("Id_Enrollment", "[0-9]+");

Route::middleware('manager.access')
	->name('school-account.list')
	->get("/schools/{Id_School}/school-accounts", [ EnrollmentController::class, "list" ])
	->where("Id_School", "[0-9]+");

Route::middleware('manager.access')
	->name('school-account.search')
	->get("/schools/{Id_School}/school-accounts/search", [ EnrollmentController::class, "search" ])
	->where("Id_School", "[0-9]+");