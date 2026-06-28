<?php

use Illuminate\Support\Facades\Route;
use App\Modules\ContractFee\Http\Controllers\Manager\ContractFeeController;


Route::middleware('manager.access')
	->name('contract-fee.create')
	->post("/contract-fees", [ ContractFeeController::class, "create" ]);

Route::middleware('manager.access')
	->name('contract-fee.update')
	->put("/contract-fees", [ ContractFeeController::class, "update" ]);

Route::middleware('manager.access')
	->name('contract-fee.delete')
	->delete("/contract-fees/{Id_ContractFee}", [ ContractFeeController::class, "delete" ])
	->where("Id_ContractFee", "[0-9]+");

Route::middleware('manager.access')
	->name('contract-fee.index')
	->get("/contract-fees/{Id_ContractFee}", [ ContractFeeController::class, "index" ])
	->where("Id_ContractFee", "[0-9]+");

Route::middleware('manager.access')
	->name('contract-fee.list')
	->get("/contracts/{Id_Contract}/contract-fees", [ ContractFeeController::class, "list" ])
	->where("Id_Contract", "[0-9]+");

Route::middleware('manager.access')
	->name('contract-fee.search')
	->get("/contracts/{Id_Contract}/contract-fees/search", [ ContractFeeController::class, "search" ])
	->where("Id_Contract", "[0-9]+");