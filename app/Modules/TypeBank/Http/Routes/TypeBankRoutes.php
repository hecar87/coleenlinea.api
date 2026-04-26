<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Manager\TypeBank\TypeBankController;


Route::middleware('manager.access')->name('type-bank.create')	->post		("/type-banks",				[ TypeBankController::class, "create" ]);
Route::middleware('manager.access')->name('type-bank.update')	->put		("/type-banks",				[ TypeBankController::class, "update" ]);
Route::middleware('manager.access')->name('type-bank.delete')	->delete	("/type-banks/{Id}",		[ TypeBankController::class, "delete" ])->where("Id", "[0-9]+");
Route::middleware('manager.access')->name('type-bank.index')	->get		("/type-banks/{Id}",		[ TypeBankController::class, "index" ])->where("Id", "[0-9]+");
Route::middleware('manager.access')->name('type-bank.list')		->get		("/type-banks",				[ TypeBankController::class, "list" ]);
Route::middleware('manager.access')->name('type-bank.search')	->get		("/type-banks/search",		[ TypeBankController::class, "search" ]);