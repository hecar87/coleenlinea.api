<?php

use Illuminate\Support\Facades\Route;
use App\Modules\SchoolBranch\Http\Controllers\Manager\SchoolBranchController;


Route::middleware('manager.access')
	->name('school-account.create')
	->post("/school-accounts", [ SchoolBranchController::class, "create" ]);

Route::middleware('manager.access')
	->name('school-account.update')
	->put("/school-accounts", [ SchoolBranchController::class, "update" ]);

Route::middleware('manager.access')
	->name('school-account.delete')
	->delete("/school-accounts/{Id_SchoolBranch}", [ SchoolBranchController::class, "delete" ])
	->where("Id_SchoolBranch", "[0-9]+");

Route::middleware('manager.access')
	->name('school-account.index')
	->get("/school-accounts/{Id_SchoolBranch}", [ SchoolBranchController::class, "index" ])
	->where("Id_SchoolBranch", "[0-9]+");

Route::middleware('manager.access')
	->name('school-account.list')
	->get("/schools/{Id_School}/school-accounts", [ SchoolBranchController::class, "list" ])
	->where("Id_School", "[0-9]+");

Route::middleware('manager.access')
	->name('school-account.search')
	->get("/schools/{Id_School}/school-accounts/search", [ SchoolBranchController::class, "search" ])
	->where("Id_School", "[0-9]+");