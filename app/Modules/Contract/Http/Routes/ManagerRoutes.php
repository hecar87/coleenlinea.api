<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Contract\Http\Controllers\Manager\ContractController;


Route::middleware('manager.access')
	->name('school-account.create')
	->post("/school-accounts", [ ContractController::class, "create" ]);

Route::middleware('manager.access')
	->name('school-account.update')
	->put("/school-accounts", [ ContractController::class, "update" ]);

Route::middleware('manager.access')
	->name('school-account.delete')
	->delete("/school-accounts/{Id_Contract}", [ ContractController::class, "delete" ])
	->where("Id_Contract", "[0-9]+");

Route::middleware('manager.access')
	->name('school-account.index')
	->get("/school-accounts/{Id_Contract}", [ ContractController::class, "index" ])
	->where("Id_Contract", "[0-9]+");

Route::middleware('manager.access')
	->name('school-account.list')
	->get("/schools/{Id_School}/school-accounts", [ ContractController::class, "list" ])
	->where("Id_School", "[0-9]+");

Route::middleware('manager.access')
	->name('school-account.search')
	->get("/schools/{Id_School}/school-accounts/search", [ ContractController::class, "search" ])
	->where("Id_School", "[0-9]+");