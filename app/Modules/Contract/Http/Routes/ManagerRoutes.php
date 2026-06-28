<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Contract\Http\Controllers\Manager\ContractController;


Route::middleware('manager.access')
	->name('contract.create')
	->post("/contracts", [ ContractController::class, "create" ]);

Route::middleware('manager.access')
	->name('contract.update')
	->put("/contracts", [ ContractController::class, "update" ]);

Route::middleware('manager.access')
	->name('contract.approve')
	->put("/contracts/{Id_Contract}/approve", [ ContractController::class, "approve" ])
	->where("Id_Contract", "[0-9]+");

Route::middleware('manager.access')
	->name('contract.nullify')
	->put("/contracts/{Id_Contract}/nullify", [ ContractController::class, "nullify" ])
	->where("Id_Contract", "[0-9]+");

Route::middleware('manager.access')
	->name('contract.close')
	->put("/contracts/{Id_Contract}/close", [ ContractController::class, "close" ])
	->where("Id_Contract", "[0-9]+");

Route::middleware('manager.access')
	->name('contract.delete')
	->delete("/contracts/{Id_Contract}", [ ContractController::class, "delete" ])
	->where("Id_Contract", "[0-9]+");

Route::middleware('manager.access')
	->name('contract.index')
	->get("/contracts/{Id_Contract}", [ ContractController::class, "index" ])
	->where("Id_Contract", "[0-9]+");

Route::middleware('manager.access')
	->name('contract.list')
	->get("/schools/{Id_School}/contracts", [ ContractController::class, "list" ])
	->where("Id_School", "[0-9]+");

Route::middleware('manager.access')
	->name('contract.search')
	->get("/schools/{Id_School}/contracts/search", [ ContractController::class, "search" ])
	->where("Id_School", "[0-9]+");