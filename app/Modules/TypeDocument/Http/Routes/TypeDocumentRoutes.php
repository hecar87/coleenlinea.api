<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Manager\TypeDocument\TypeDocumentController;


Route::middleware('manager.access')->name('type-document.create')	->post		("/type-documents",			[ TypeDocumentController::class, "create" ]);
Route::middleware('manager.access')->name('type-document.update')	->put		("/type-documents",			[ TypeDocumentController::class, "update" ]);
Route::middleware('manager.access')->name('type-document.delete')	->delete	("/type-documents/{Id}",	[ TypeDocumentController::class, "delete" ])->where("Id", "[0-9]+");
Route::middleware('manager.access')->name('type-document.index')	->get		("/type-documents/{Id}",	[ TypeDocumentController::class, "index" ])->where("Id", "[0-9]+");
Route::middleware('manager.access')->name('type-document.list')		->get		("/type-documents",			[ TypeDocumentController::class, "list" ]);
Route::middleware('manager.access')->name('type-document.search')	->get		("/type-documents/search",	[ TypeDocumentController::class, "search" ]);