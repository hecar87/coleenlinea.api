<?php

use Illuminate\Support\Facades\Route;
use App\Modules\ContractFee\Http\Controllers\Manager\ContractFeeController;


Route::middleware('manager.access')
	->name('school-account.create')
	->post("/school-accounts", [ ContractFeeController::class, "create" ]);

Route::middleware('manager.access')
	->name('school-account.update')
	->put("/school-accounts", [ ContractFeeController::class, "update" ]);

Route::middleware('manager.access')
	->name('school-account.delete')
	->delete("/school-accounts/{Id_ContractFee}", [ ContractFeeController::class, "delete" ])
	->where("Id_ContractFee", "[0-9]+");

Route::middleware('manager.access')
	->name('school-account.index')
	->get("/school-accounts/{Id_ContractFee}", [ ContractFeeController::class, "index" ])
	->where("Id_ContractFee", "[0-9]+");

Route::middleware('manager.access')
	->name('school-account.list')
	->get("/schools/{Id_School}/school-accounts", [ ContractFeeController::class, "list" ])
	->where("Id_School", "[0-9]+");

Route::middleware('manager.access')
	->name('school-account.search')
	->get("/schools/{Id_School}/school-accounts/search", [ ContractFeeController::class, "search" ])
	->where("Id_School", "[0-9]+");