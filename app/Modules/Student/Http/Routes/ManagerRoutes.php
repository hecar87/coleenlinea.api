<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Student\Http\Controllers\Manager\StudentController;


Route::middleware('manager.access')
	->name('student.create')
	->post("/students", [ StudentController::class, "create" ]);

Route::middleware('manager.access')
	->name('student.update')
	->put("/students", [ StudentController::class, "update" ]);

Route::middleware('manager.access')
	->name('student.verify')
	->put("/students/{Id_Student}/verify", [ StudentController::class, "verify" ])
	->where("Id_Student", "[0-9]+");

Route::middleware('manager.access')
	->name('student.activate')
	->put("/students/{Id_Student}/activate", [ StudentController::class, "activate" ])
	->where("Id_Student", "[0-9]+");

Route::middleware('manager.access')
	->name('student.deactivate')
	->put("/students/{Id_Student}/deactivate", [ StudentController::class, "deactivate" ])
	->where("Id_Student", "[0-9]+");

Route::middleware('manager.access')
	->name('student.delete')
	->delete("/students/{Id_Student}", [ StudentController::class, "delete" ])
	->where("Id_Student", "[0-9]+");

Route::middleware('manager.access')
	->name('student.index')
	->get("/students/{Id_Student}", [ StudentController::class, "index" ])
	->where("Id_Student", "[0-9]+");

Route::middleware('manager.access')
	->name('student.list')
	->get("/students", [ StudentController::class, "list" ]);

Route::middleware('manager.access')
	->name('student.search')
	->get("/students/search", [ StudentController::class, "search" ]);