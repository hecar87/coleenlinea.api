<?php

use Illuminate\Support\Facades\Route;
use App\Modules\EnrollmentInstallment\Http\Controllers\Manager\EnrollmentInstallmentController;


Route::middleware('manager.access')
	->name('enrollment-installment.create')
	->post("/enrollment-installments", [ EnrollmentInstallmentController::class, "create" ]);

Route::middleware('manager.access')
	->name('enrollment-installment.update')
	->put("/enrollment-installments", [ EnrollmentInstallmentController::class, "update" ]);

Route::middleware('manager.access')
	->name('enrollment-installment.pay')
	->put("/enrollment-installments/{Id_EnrollmentInstallment}/pay", [ EnrollmentInstallmentController::class, "pay" ])
	->where("Id_EnrollmentInstallment", "[0-9]+");

Route::middleware('manager.access')
	->name('enrollment-installment.nullify')
	->put("/enrollment-installments/{Id_EnrollmentInstallment}/nullify", [ EnrollmentInstallmentController::class, "nullify" ])
	->where("Id_EnrollmentInstallment", "[0-9]+");

Route::middleware('manager.access')
	->name('enrollment-installment.delete')
	->delete("/enrollment-installments/{Id_EnrollmentInstallment}", [ EnrollmentInstallmentController::class, "delete" ])
	->where("Id_EnrollmentInstallment", "[0-9]+");

Route::middleware('manager.access')
	->name('enrollment-installment.index')
	->get("/enrollment-installments/{Id_EnrollmentInstallment}", [ EnrollmentInstallmentController::class, "index" ])
	->where("Id_EnrollmentInstallment", "[0-9]+");

Route::middleware('manager.access')
	->name('enrollment-installment.list')
	->get("/enrollments/{Id_Enrollment}/enrollment-installments", [ EnrollmentInstallmentController::class, "list" ])
	->where("Id_Enrollment", "[0-9]+");

Route::middleware('manager.access')
	->name('enrollment-installment.search')
	->get("/enrollments/{Id_Enrollment}/enrollment-installments/search", [ EnrollmentInstallmentController::class, "search" ])
	->where("Id_Enrollment", "[0-9]+");