<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Enrollment\Http\Controllers\Manager\EnrollmentController;


Route::middleware('manager.access')
	->name('enrollment.create')
	->post("/enrollments", [ EnrollmentController::class, "create" ]);

Route::middleware('manager.access')
	->name('enrollment.update')
	->put("/enrollments", [ EnrollmentController::class, "update" ]);

Route::middleware('manager.access')
	->name('enrollment.enroll')
	->put("/enrollments/{Id_Enrollment}/enroll", [ EnrollmentController::class, "enroll" ])
	->where("Id_Enrollment", "[0-9]+");

Route::middleware('manager.access')
	->name('enrollment.nullify')
	->put("/enrollments/{Id_Enrollment}/nullify", [ EnrollmentController::class, "nullify" ])
	->where("Id_Enrollment", "[0-9]+");

Route::middleware('manager.access')
	->name('enrollment.delete')
	->delete("/enrollments/{Id_Enrollment}", [ EnrollmentController::class, "delete" ])
	->where("Id_Enrollment", "[0-9]+");

Route::middleware('manager.access')
	->name('enrollment.index')
	->get("/enrollments/{Id_Enrollment}", [ EnrollmentController::class, "index" ])
	->where("Id_Enrollment", "[0-9]+");

Route::middleware('manager.access')
	->name('enrollment.list-by-school-class')
	->get("/school-classes/{Id_SchoolClass}/enrollments", [ EnrollmentController::class, "listBySchoolClass" ])
	->where("Id_SchoolClass", "[0-9]+");

Route::middleware('manager.access')
	->name('enrollment.list-by-student')
	->get("/students/{Id_Student}/enrollments", [ EnrollmentController::class, "listByStudent" ])
	->where("Id_Student", "[0-9]+");

Route::middleware('manager.access')
	->name('enrollment.search-by-school-class')
	->get("/school-classes/{Id_SchoolClass}/enrollments/search", [ EnrollmentController::class, "searchBySchoolClass" ])
	->where("Id_SchoolClass", "[0-9]+");

Route::middleware('manager.access')
	->name('enrollment.search-by-school-year')
	->get("/school-years/{Id_SchoolYear}/enrollments/search", [ EnrollmentController::class, "searchBySchoolYear" ])
	->where("Id_SchoolYear", "[0-9]+");

Route::middleware('manager.access')
	->name('enrollment.search-by-student')
	->get("/students/{Id_Student}/enrollments/search", [ EnrollmentController::class, "searchByStudent" ])
	->where("Id_Student", "[0-9]+");