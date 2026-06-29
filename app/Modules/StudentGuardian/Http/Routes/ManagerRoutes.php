<?php

use Illuminate\Support\Facades\Route;
use App\Modules\StudentGuardian\Http\Controllers\Manager\StudentGuardianController;


Route::middleware('manager.access')
	->name('student-guardian.create')
	->post("/student-guardians", [ StudentGuardianController::class, "create" ]);

Route::middleware('manager.access')
	->name('student-guardian.update')
	->put("/student-guardians", [ StudentGuardianController::class, "update" ]);

Route::middleware('manager.access')
	->name('student-guardian.delete')
	->delete("/student-guardians/{Id_StudentGuardian}", [ StudentGuardianController::class, "delete" ])
	->where("Id_StudentGuardian", "[0-9]+");

Route::middleware('manager.access')
	->name('student-guardian.index')
	->get("/student-guardians/{Id_StudentGuardian}", [ StudentGuardianController::class, "index" ])
	->where("Id_StudentGuardian", "[0-9]+");

Route::middleware('manager.access')
	->name('student-guardian.list')
	->get("/guardians/{Id_Guardian}/student-guardians", [ StudentGuardianController::class, "listByGuardian" ])
	->where("Id_Guardian", "[0-9]+");

Route::middleware('manager.access')
	->name('student-guardian.list')
	->get("/students/{Id_Student}/student-guardians", [ StudentGuardianController::class, "listByStudent" ])
	->where("Id_Student", "[0-9]+");

Route::middleware('manager.access')
	->name('student-guardian.search')
	->get("/guardians/{Id_Guardian}/student-guardians/search", [ StudentGuardianController::class, "searchByGuardian" ])
	->where("Id_Guardian", "[0-9]+");

Route::middleware('manager.access')
	->name('student-guardian.search')
	->get("/students/{Id_Student}/student-guardians/search", [ StudentGuardianController::class, "searchByStudent" ])
	->where("Id_Student", "[0-9]+");