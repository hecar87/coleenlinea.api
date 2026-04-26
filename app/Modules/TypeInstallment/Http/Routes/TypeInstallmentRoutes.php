<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Manager\TypeInstallment\TypeInstallmentController;


Route::middleware('manager.access')->name('type-installment.create')	->post		("/type-installments",			[ TypeInstallmentController::class, "create" ]);
Route::middleware('manager.access')->name('type-installment.update')	->put		("/type-installments",			[ TypeInstallmentController::class, "update" ]);
Route::middleware('manager.access')->name('type-installment.delete')	->delete	("/type-installments/{Id}",		[ TypeInstallmentController::class, "delete" ])->where("Id", "[0-9]+");
Route::middleware('manager.access')->name('type-installment.index')		->get		("/type-installments/{Id}",		[ TypeInstallmentController::class, "index" ])->where("Id", "[0-9]+");
Route::middleware('manager.access')->name('type-installment.list')		->get		("/type-installments",			[ TypeInstallmentController::class, "list" ]);
Route::middleware('manager.access')->name('type-installment.search')	->get		("/type-installments/search",	[ TypeInstallmentController::class, "search" ]);