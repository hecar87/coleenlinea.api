<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Guardian\Http\Controllers\Manager\GuardianController;


Route::middleware('manager.access')
	->name('guardian.create')
	->post("/guardians", [ GuardianController::class, "create" ]);

Route::middleware('manager.access')
	->name('guardian.update')
	->put("/guardians", [ GuardianController::class, "update" ]);

Route::middleware('manager.access')
	->name('guardian.delete')
	->delete("/guardians/{Id_Guardian}", [ GuardianController::class, "delete" ])
	->where("Id_Guardian", "[0-9]+");

Route::middleware('manager.access')
	->name('guardian.index')
	->get("/guardians/{Id_Guardian}", [ GuardianController::class, "index" ])
	->where("Id_Guardian", "[0-9]+");

Route::middleware('manager.access')
	->name('guardian.list')
	->get("/guardians", [ GuardianController::class, "list" ]);

Route::middleware('manager.access')
	->name('guardian.search')
	->get("/guardians/search", [ GuardianController::class, "search" ]);