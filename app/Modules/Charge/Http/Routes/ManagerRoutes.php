<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Charge\Http\Controllers\Manager\ChargeController;


Route::middleware('manager.access')
	->name('charge.create')
	->post("/charges", [ ChargeController::class, "create" ]);

Route::middleware('manager.access')
	->name('charge.update')
	->put("/charges", [ ChargeController::class, "update" ]);

Route::middleware('manager.access')
	->name('charge.delete')
	->delete("/charges/{Id_Charge}", [ ChargeController::class, "delete" ])
	->where("Id_Charge", "[0-9]+");

Route::middleware('manager.access')
	->name('charge.index')
	->get("/charges/{Id_Charge}", [ ChargeController::class, "index" ])
	->where("Id_Charge", "[0-9]+");

Route::middleware('manager.access')
	->name('charge.list')
	->get("/charges", [ ChargeController::class, "list" ]);

Route::middleware('manager.access')
	->name('charge.list')
	->get("/guardians/{Id_Guardian}/charges", [ ChargeController::class, "listByGuardian" ])
	->where("Id_Guardian", "[0-9]+");

Route::middleware('manager.access')
	->name('charge.search')
	->get("/charges/search", [ ChargeController::class, "search" ]);

Route::middleware('manager.access')
	->name('charge.search')
	->get("/guardians/{Id_Guardian}/charges/search", [ ChargeController::class, "searchByGuardian" ])
	->where("Id_Guardian", "[0-9]+");