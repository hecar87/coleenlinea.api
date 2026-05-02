<?php

use Illuminate\Support\Facades\Route;
use App\Modules\TypeCurrency\Http\Controllers\Manager\TypeCurrencyController;


Route::middleware('manager.access')->name('type-currency.create')	->post		("/type-currencies",		[ TypeCurrencyController::class, "create" ]);
Route::middleware('manager.access')->name('type-currency.update')	->put		("/type-currencies",		[ TypeCurrencyController::class, "update" ]);
Route::middleware('manager.access')->name('type-currency.delete')	->delete	("/type-currencies/{Id}",	[ TypeCurrencyController::class, "delete" ])->where("Id", "[0-9]+");
Route::middleware('manager.access')->name('type-currency.index')	->get		("/type-currencies/{Id}",	[ TypeCurrencyController::class, "index" ])->where("Id", "[0-9]+");
Route::middleware('manager.access')->name('type-currency.list')		->get		("/type-currencies",		[ TypeCurrencyController::class, "list" ]);
Route::middleware('manager.access')->name('type-currency.search')	->get		("/type-currencies/search",	[ TypeCurrencyController::class, "search" ]);