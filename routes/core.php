<?php


use App\Http\Controllers\Core\AdminController;
use App\Http\Controllers\Core\ClientController;

Route::get('/dashboard', [AdminController::class, 'index'])
		->middleware(['auth'])->name('dashboard');

// Route::get('/sample', function () {
//         $content = "hi";
//     return view('apps.sample')->with('theme','themes.xyz.layouts.app')->with('content',$content);
// });



Route::get('/client', [ClientController::class, 'index'])
		->middleware(['auth'])->name('Client.index');

Route::get('/client/create', [ClientController::class, 'create'])
		->middleware(['auth'])->name('Client.create');
Route::get('/client/{client}', [ClientController::class, 'show'])
		->middleware(['auth'])->name('Client.show');

Route::get('/client/{client}/edit', [ClientController::class, 'edit'])
		->middleware(['auth'])->name('Client.edit');

Route::post('/client', [ClientController::class, 'store'])
		->middleware(['auth'])->name('Client.store');
Route::put('/client/{client}', [ClientController::class, 'update'])
		->middleware(['auth'])->name('Client.update');
Route::delete('/client/{client}', [ClientController::class, 'destroy'])
		->middleware(['auth'])->name('Client.destroy');
