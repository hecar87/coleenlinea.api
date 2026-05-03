<?php

use Illuminate\Support\Facades\Route;
use App\Modules\TypeFee\Http\Controllers\Manager\TypeFeeController;


Route::middleware('manager.access')->name('type-fee.create')	->post		("/type-fees",			[ TypeFeeController::class, "create" ]);
Route::middleware('manager.access')->name('type-fee.update')	->put		("/type-fees",			[ TypeFeeController::class, "update" ]);
Route::middleware('manager.access')->name('type-fee.delete')	->delete	("/type-fees/{Id}",		[ TypeFeeController::class, "delete" ])->where("Id", "[0-9]+");
Route::middleware('manager.access')->name('type-fee.index')		->get		("/type-fees/{Id}",		[ TypeFeeController::class, "index" ])->where("Id", "[0-9]+");
Route::middleware('manager.access')->name('type-fee.list')		->get		("/type-fees",			[ TypeFeeController::class, "list" ]);
Route::middleware('manager.access')->name('type-fee.search')	->get		("/type-fees/search",	[ TypeFeeController::class, "search" ]);