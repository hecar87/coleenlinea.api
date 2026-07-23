<?php

use Illuminate\Support\Facades\Route;
use App\Modules\SchoolInstallment\Http\Controllers\Manager\SchoolInstallmentController;


Route::middleware('manager.access')
	->name('school-installment.create')
	->post("/school-installments", [ SchoolInstallmentController::class, "create" ]);

Route::middleware('manager.access')
	->name('school-installment.update')
	->put("/school-installments", [ SchoolInstallmentController::class, "update" ]);

Route::middleware('manager.access')
	->name('school-installment.delete')
	->delete("/school-installments/{Id_SchoolInstallment}", [ SchoolInstallmentController::class, "delete" ])
	->where("Id_SchoolInstallment", "[0-9]+");

Route::middleware('manager.access')
	->name('school-installment.index')
	->get("/school-installments/{Id_SchoolInstallment}", [ SchoolInstallmentController::class, "index" ])
	->where("Id_SchoolInstallment", "[0-9]+");

Route::middleware('manager.access')
	->name('school-installment.list')
	->get("/school-profiles/{Id_SchoolProfile}/school-installments", [ SchoolInstallmentController::class, "list" ])
	->where("Id_SchoolProfile", "[0-9]+");

Route::middleware('manager.access')
	->name('school-installment.search')
	->get("/school-profiles/{Id_SchoolProfile}/school-installments/search", [ SchoolInstallmentController::class, "search" ])
	->where("Id_SchoolProfile", "[0-9]+");