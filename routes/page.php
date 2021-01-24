<?php
use App\Http\Controllers\Page\PageController;

Route::get('/page', [PageController::class, 'index'])
		->middleware(['auth'])->name('Page.index');
Route::get('/page/create', [PageController::class, 'create'])
		->middleware(['auth'])->name('Page.create');

Route::get('/page/{page}/edit', [PageController::class, 'edit'])
		->middleware(['auth'])->name('Page.edit');
Route::post('/page', [PageController::class, 'store'])
		->middleware(['auth'])->name('Page.store');
Route::put('/page/{page}', [PageController::class, 'update'])
		->middleware(['auth'])->name('Page.update');
Route::delete('/page/{page}', [PageController::class, 'destroy'])
		->middleware(['auth'])->name('Page.destroy');


Route::get('/page/{page}', [PageController::class, 'show'])
		->middleware(['auth'])->name('Page.show');

Route::get('/{page}', [PageController::class, 'public'])->name('Page.public');
Route::get('/{page}/{u1}', [PageController::class, 'public'])->name('Page.public');
Route::get('/{page}/{u1}/{u2}', [PageController::class, 'public'])->name('Page.public');
Route::get('/{page}/{u1}/{u2}/{u3}', [PageController::class, 'public'])->name('Page.public');
