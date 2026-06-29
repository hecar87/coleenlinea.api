<?php

use Illuminate\Support\Facades\Route;
use App\Modules\StudentGuardian\Http\Controllers\Manager\StudentGuardianController;


Route::middleware('manager.access')
	->name('student-guardian.create')
	->post("/student-guardian", [ StudentGuardianController::class, "create" ]);

Route::middleware('manager.access')
	->name('student-guardian.update')
	->put("/student-guardian", [ StudentGuardianController::class, "update" ]);

Route::middleware('manager.access')
	->name('student-guardian.delete')
	->delete("/student-guardian/{Id_StudentGuardian}", [ StudentGuardianController::class, "delete" ])
	->where("Id_StudentGuardian", "[0-9]+");

Route::middleware('manager.access')
	->name('student-guardian.index')
	->get("/student-guardian/{Id_StudentGuardian}", [ StudentGuardianController::class, "index" ])
	->where("Id_StudentGuardian", "[0-9]+");

Route::middleware('manager.access')
	->name('student-guardian.list')
	->get("/guardians/{Id_Guardian}/student-guardian", [ StudentGuardianController::class, "listByGuardian" ])
	->where("Id_Guardian", "[0-9]+");

Route::middleware('manager.access')
	->name('student-guardian.list')
	->get("/students/{Id_Student}/student-guardian", [ StudentGuardianController::class, "listByStudent" ])
	->where("Id_Student", "[0-9]+");

Route::middleware('manager.access')
	->name('student-guardian.search')
	->get("/guardians/{Id_Guardian}/student-guardian/search", [ StudentGuardianController::class, "searchByGuardian" ])
	->where("Id_Guardian", "[0-9]+");

Route::middleware('manager.access')
	->name('student-guardian.search')
	->get("/students/{Id_Student}/student-guardian/search", [ StudentGuardianController::class, "searchByStudent" ])
	->where("Id_Student", "[0-9]+");