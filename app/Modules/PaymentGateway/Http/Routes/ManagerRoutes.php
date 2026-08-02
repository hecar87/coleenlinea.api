<?php

use Illuminate\Support\Facades\Route;
use App\Modules\PaymentGateway\Http\Controllers\Manager\PaymentGatewayController;


Route::middleware('manager.access')->name('state.create')	->post		("/states",				[ PaymentGatewayController::class, "create" ]);
Route::middleware('manager.access')->name('state.update')	->put		("/states",				[ PaymentGatewayController::class, "update" ]);
Route::middleware('manager.access')->name('state.delete')	->delete	("/states/{Id_PaymentGateway}",	[ PaymentGatewayController::class, "delete" ])->where("Id_PaymentGateway", "[0-9]+");
Route::middleware('manager.access')->name('state.index')	->get		("/states/{Id_PaymentGateway}",	[ PaymentGatewayController::class, "index" ])->where("Id_PaymentGateway", "[0-9]+");
Route::middleware('manager.access')->name('state.list')		->get		("/states",				[ PaymentGatewayController::class, "list" ]);
Route::middleware('manager.access')->name('state.search')	->get		("/states/search",		[ PaymentGatewayController::class, "search" ]);