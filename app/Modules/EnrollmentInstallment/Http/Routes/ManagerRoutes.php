<?php

use Illuminate\Support\Facades\Route;
use App\Modules\EnrollmentInstallment\Http\Controllers\Manager\EnrollmentInstallmentController;


Route::middleware('manager.access')
	->name('school-account.create')
	->post("/school-accounts", [ EnrollmentInstallmentController::class, "create" ]);

Route::middleware('manager.access')
	->name('school-account.update')
	->put("/school-accounts", [ EnrollmentInstallmentController::class, "update" ]);

Route::middleware('manager.access')
	->name('school-account.delete')
	->delete("/school-accounts/{Id_EnrollmentInstallment}", [ EnrollmentInstallmentController::class, "delete" ])
	->where("Id_EnrollmentInstallment", "[0-9]+");

Route::middleware('manager.access')
	->name('school-account.index')
	->get("/school-accounts/{Id_EnrollmentInstallment}", [ EnrollmentInstallmentController::class, "index" ])
	->where("Id_EnrollmentInstallment", "[0-9]+");

Route::middleware('manager.access')
	->name('school-account.list')
	->get("/schools/{Id_School}/school-accounts", [ EnrollmentInstallmentController::class, "list" ])
	->where("Id_School", "[0-9]+");

Route::middleware('manager.access')
	->name('school-account.search')
	->get("/schools/{Id_School}/school-accounts/search", [ EnrollmentInstallmentController::class, "search" ])
	->where("Id_School", "[0-9]+");