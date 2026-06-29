<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Student\Http\Controllers\Manager\StudentController;


Route::middleware('manager.access')
	->name('guardian.create')
	->post("/guardians", [ StudentController::class, "create" ]);

Route::middleware('manager.access')
	->name('guardian.update')
	->put("/guardians", [ StudentController::class, "update" ]);

Route::middleware('manager.access')
	->name('guardian.verify')
	->put("/guardians/{Id_Student}/verify", [ StudentController::class, "verify" ])
	->where("Id_Student", "[0-9]+");

Route::middleware('manager.access')
	->name('guardian.activate')
	->put("/guardians/{Id_Student}/activate", [ StudentController::class, "activate" ])
	->where("Id_Student", "[0-9]+");

Route::middleware('manager.access')
	->name('guardian.deactivate')
	->put("/guardians/{Id_Student}/deactivate", [ StudentController::class, "deactivate" ])
	->where("Id_Student", "[0-9]+");

Route::middleware('manager.access')
	->name('guardian.delete')
	->delete("/guardians/{Id_Student}", [ StudentController::class, "delete" ])
	->where("Id_Student", "[0-9]+");

Route::middleware('manager.access')
	->name('guardian.index')
	->get("/guardians/{Id_Student}", [ StudentController::class, "index" ])
	->where("Id_Student", "[0-9]+");

Route::middleware('manager.access')
	->name('guardian.list')
	->get("/guardians", [ StudentController::class, "list" ]);

Route::middleware('manager.access')
	->name('guardian.search')
	->get("/guardians/search", [ StudentController::class, "search" ]);