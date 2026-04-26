<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Manager\TypeReceipt\TypeReceiptController;


Route::middleware('manager.access')->name('type-receipt.create')	->post		("/type-receipts",			[ TypeReceiptController::class, "create" ]);
Route::middleware('manager.access')->name('type-receipt.update')	->put		("/type-receipts",			[ TypeReceiptController::class, "update" ]);
Route::middleware('manager.access')->name('type-receipt.delete')	->delete	("/type-receipts/{Id}",		[ TypeReceiptController::class, "delete" ])->where("Id", "[0-9]+");
Route::middleware('manager.access')->name('type-receipt.index')		->get		("/type-receipts/{Id}",		[ TypeReceiptController::class, "index" ])->where("Id", "[0-9]+");
Route::middleware('manager.access')->name('type-receipt.list')		->get		("/type-receipts",			[ TypeReceiptController::class, "list" ]);
Route::middleware('manager.access')->name('type-receipt.search')	->get		("/type-receipts/search",	[ TypeReceiptController::class, "search" ]);