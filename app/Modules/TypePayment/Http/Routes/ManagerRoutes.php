<?php

use Illuminate\Support\Facades\Route;
use App\modules\TypePayment\Http\Controllers\Manager\TypePaymentController;


Route::middleware('manager.access')->name('type-payment.create')	->post		("/type-payments",			[ TypePaymentController::class, "create" ]);
Route::middleware('manager.access')->name('type-payment.update')	->put		("/type-payments",			[ TypePaymentController::class, "update" ]);
Route::middleware('manager.access')->name('type-payment.delete')	->delete	("/type-payments/{Id}",		[ TypePaymentController::class, "delete" ])->where("Id", "[0-9]+");
Route::middleware('manager.access')->name('type-payment.index')		->get		("/type-payments/{Id}",		[ TypePaymentController::class, "index" ])->where("Id", "[0-9]+");
Route::middleware('manager.access')->name('type-payment.list')		->get		("/type-payments",			[ TypePaymentController::class, "list" ]);
Route::middleware('manager.access')->name('type-payment.search')	->get		("/type-payments/search",	[ TypePaymentController::class, "search" ]);