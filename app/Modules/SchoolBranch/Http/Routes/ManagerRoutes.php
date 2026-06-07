<?php

use Illuminate\Support\Facades\Route;
use App\Modules\SchoolBranch\Http\Controllers\Manager\SchoolBranchController;


Route::middleware('manager.access')
	->name('school-branch.create')
	->post("/school-branches", [ SchoolBranchController::class, "create" ]);

Route::middleware('manager.access')
	->name('school-branch.update')
	->put("/school-branches", [ SchoolBranchController::class, "update" ]);

Route::middleware('manager.access')
	->name('school-branch.delete')
	->delete("/school-branches/{Id_SchoolBranch}", [ SchoolBranchController::class, "delete" ])
	->where("Id_SchoolBranch", "[0-9]+");

Route::middleware('manager.access')
	->name('school-branch.index')
	->get("/school-branches/{Id_SchoolBranch}", [ SchoolBranchController::class, "index" ])
	->where("Id_SchoolBranch", "[0-9]+");

Route::middleware('manager.access')
	->name('school-branch.list')
	->get("/schools/{Id_School}/school-branches", [ SchoolBranchController::class, "list" ])
	->where("Id_School", "[0-9]+");

Route::middleware('manager.access')
	->name('school-branch.search')
	->get("/schools/{Id_School}/school-branches/search", [ SchoolBranchController::class, "search" ])
	->where("Id_School", "[0-9]+");